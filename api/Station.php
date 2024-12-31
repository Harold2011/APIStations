<?php

class Station {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

      public function getStationData() {
      $query = "
          SELECT 
              s.id AS station_id, 
              s.Name AS station_name, 
              s.Description AS station_description, 
              s.location AS station_location, 
              u.id AS user_id,
              u.Name AS user_name,
              sen.id AS sensor_id, 
              sen.Name AS sensor_name, 
              sen.unit_measurement AS sensor_unit, 
              p.id AS parameter_id, 
              p.measurement AS parameter_measurement, 
              p.dataTime AS parameter_dataTime
          FROM Station s
          LEFT JOIN Users u ON s.id_user = u.id
          LEFT JOIN Parameter p ON s.id = p.id_station
          LEFT JOIN sensor sen ON p.id_sensor = sen.id
          ORDER BY s.id, sen.id, p.dataTime
      ";

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      $data = [];
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $stationId = $row['station_id'];
          $sensorId = $row['sensor_id'];

          // Agrupar por estación
          if (!isset($data[$stationId])) {
              $data[$stationId] = [
                  'station_id' => $row['station_id'],
                  'station_name' => $row['station_name'],
                  'station_description' => $row['station_description'],
                  'station_location' => $row['station_location'],
                  'user' => [
                      'user_id' => $row['user_id'],
                      'user_name' => $row['user_name']
                  ],
                  'sensors' => []
              ];
          }

          // Agrupar por sensor dentro de la estación
          if ($sensorId && !isset($data[$stationId]['sensors'][$sensorId])) {
              $data[$stationId]['sensors'][$sensorId] = [
                  'sensor_id' => $row['sensor_id'],
                  'sensor_name' => $row['sensor_name'],
                  'sensor_unit' => $row['sensor_unit'],
                  'parameters' => []
              ];
          }

          // Agregar parámetros al sensor
          if ($row['parameter_id']) {
              $data[$stationId]['sensors'][$sensorId]['parameters'][] = [
                  'parameter_id' => $row['parameter_id'],
                  'measurement' => $row['parameter_measurement'],
                  'dataTime' => $row['parameter_dataTime']
              ];
          }
      }

      // Convertir las claves asociativas a índices numéricos
      $result = array_values(array_map(function ($station) {
          $station['sensors'] = array_values($station['sensors']);
          return $station;
      }, $data));

      return $result;
  }

}
