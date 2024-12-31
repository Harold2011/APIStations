#Esta API permite manejar informacion de estaciones por medio de IoT


Endpoint para visualzar parametros

http://localhost/station1.discientic.com/index.php?endpoint=stations
metodo GET
ejemplo de respuesta

[
    {
        "station_id": 1,
        "station_name": "Estación Santa Marta",
        "station_description": "Estación Santa Marta",
        "station_location": "Estación Santa Marta",
        "user": {
            "user_id": 1,
            "user_name": "Admin"
        },
        "sensors": [
            {
                "sensor_id": 1,
                "sensor_name": "COR1",
                "sensor_unit": "Amperio",
                "parameters": [
                    {
                        "parameter_id": 3,
                        "measurement": 20,
                        "dataTime": "2024-12-16 15:22:53"
                    }
                ]
            }
        ]
    }
]




