# API de Gestión de Estaciones IoT 🌐

Esta API permite manejar información de estaciones a través de dispositivos IoT. Con ella, puedes gestionar estaciones, sensores, parámetros y más.

---

## ✨ Funcionalidades Principales
- Gestión de estaciones.
- Visualización de parámetros de sensores.
- Relación entre sensores y estaciones.
- Registro de parámetros con sus respectivas unidades de medida.

---

## 🖥️ Endpoint: Visualizar Parámetros de Estaciones

### URL
`GET` [http://localhost/station1.discientic.com/index.php?endpoint=stations](http://localhost/station1.discientic.com/index.php?endpoint=stations)

### Descripción
Este endpoint permite obtener la información de las estaciones registradas, junto con sus sensores y parámetros asociados.

### Ejemplo de Solicitud
```bash
curl -X GET "http://localhost/station1.discientic.com/index.php?endpoint=stations"


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

