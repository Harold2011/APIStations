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
```
```json

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
```
## 🖥️ Endpoint: Registrar Usuario

### URL
`POST` [http://localhost/station1.discientic.com/index.php?endpoint=register](http://localhost/station1.discientic.com/index.php?endpoint=register)

### Descripción
Este endpoint permite registrar un nuevo usuario en el sistema con los datos básicos como nombre, correo electrónico, contraseña y el rol.

### Body de la Solicitud
El body debe enviarse en formato JSON con la siguiente estructura:
```json
{
    "name": "ejemplo",
    "email": "ejemplo@example.com",
    "password": "12345678",
    "role_id": 2
}
```
### Ejemplo de Solicitud
```bash
curl -X POST "http://localhost/station1.discientic.com/index.php?endpoint=register" \
-H "Content-Type: application/json" \
-d '{
    "name": "ejemplo",
    "email": "ejemplo@example.com",
    "password": "12345678",
    "role_id": 2
}'
```
### Ejemplo de Respuesta Exitosa
```json
{
    "success": "User registered successfully"
}

```
## 🔒 Endpoint: Login de Usuario

### URL
`POST` [http://localhost/index.php?endpoint=login](http://tu-servidor/index.php?endpoint=login)

### Descripción
Este endpoint permite a los usuarios iniciar sesión en el sistema proporcionando su correo electrónico y contraseña.

---

### Body de la Solicitud
El body debe enviarse en formato JSON con la siguiente estructura:

```json
{
    "email": "ejemplo@example.com",
    "password": "12345678"
}
```

### Ejemplo de Solicitud

```bash
curl -X POST "http://tu-servidor/index.php?endpoint=login" \
-H "Content-Type: application/json" \
-d '{
    "email": "ejemplo@example.com",
    "password": "12345678"
}'
```

### Ejemplo de Respuesta Exitosa
```json
{
    "success": "Login successful",
    "user": {
        "id": 3,
        "Name": "ejemplo",
        "Email": "ejemplo@example.com",
        "id_role": 2
    }
}
```
## Posibles Errores

### 1.Contraseña Incorrecta
```json
{
    "error": "Invalid password"
}
```

### 2.Usuario no Encontrado
```json
{
    "error": "No user found with the provided email"
}

```
### 3.Campos Faltantes
```json
{
    "error": "Email and password are required"
}


```    
## 📋 Endpoint: Crear Board

### URL
`POST` [http://localhost/station1.discientic.com/index.php?endpoint=board](http://localhost/station1.discientic.com/index.php?endpoint=board)

### Descripción
Este endpoint permite crear un nuevo board proporcionando su nombre.

---

### Body de la Solicitud
El body debe enviarse en formato JSON con la siguiente estructura:

```json
{
  "name": "Mi Nuevo Board"
}
```

### Ejemplo de Solicitud
```bash

curl -X POST "http://localhost/station1.discientic.com/index.php?endpoint=board" \
-H "Content-Type: application/json" \
-d '{
  "name": "Mi Nuevo Board"
}'
```

### Ejemplo de Respuesta Exitosa
```json
{
    "success": "Board created successfully",
    "board_id": "2"
}
```

## 📋 Endpoint: Asociar Estación con Board

### URL
`POST` [http://localhost/station1.discientic.com/index.php?endpoint=station_board](http://localhost/station1.discientic.com/index.php?endpoint=station_board)

### Descripción
Este endpoint permite asociar una estación con un board específico.

---

### Body de la Solicitud (Método POST)
El body debe enviarse en formato JSON con la siguiente estructura:

```json
{
  "action": "create",
  "boardId": 1,
  "stationId": 1
}
```

### Ejemplo de Solicitud (Método POST)
```bash
curl -X POST "http://localhost/station1.discientic.com/index.php?endpoint=station_board" \
-H "Content-Type: application/json" \
-d '{
  "action": "create",
  "boardId": 1,
  "stationId": 1
}'
```
### Ejemplo de Respuesta Exitosa (POST)
```json
{
    "success": "Station successfully associated with board",
    "station_board_id": "4"
}

```
## 📋 Endpoint: Consultar Estaciones Asociadas a un Board

### URL
`GET` [http://localhost/station1.discientic.com/index.php?endpoint=station_board](http://localhost/station1.discientic.com/index.php?endpoint=station_board)

### Descripción
Este endpoint permite consultar las estaciones asociadas a un board específico.

---

### Body de la Solicitud (Método GET)
El body debe enviarse en formato JSON con la siguiente estructura:

```json
{
  "boardId": 1
}

```

### Ejemplo de Solicitud (Método GET)
```bash
curl -X GET "http://localhost/station1.discientic.com/index.php?endpoint=station_board" \
-H "Content-Type: application/json" \
-d '{
  "boardId": 1
}'
```

### Respuesta
```json
[
    {
        "id": 2,
        "id_board": 1,
        "id_station": 1
    },
    {
        "id": 4,
        "id_board": 1,
        "id_station": 1
    },
    {
        "id": 5,
        "id_board": 1,
        "id_station": 1
    }
]
```


### POST: Crear una nueva tabla

**URL**: `http://localhost/station1.discientic.com/index.php?endpoint=table`

**Cuerpo de la solicitud (JSON)**:
```json
{
  "name": "Mi Tabla",
  "id_board": 1
}
```
### Respuesta (JSON):
```json
{
    "success": "Table created successfully",
    "table_id": "2"
}
### POST: Asociar un sensor a una tabla

**URL**: `http://localhost/station1.discientic.com/index.php?endpoint=table_sensor`

**Cuerpo de la solicitud (JSON)**:
```json
{
  "action": "create",
  "tableId": 1,
  "sensorId": 2
}
```

### Respuesta (JSON):
```json
{
    "success": "Sensor successfully associated with table",
    "table_sensor_id": "3"
}
```

### GET http://localhost/station1.discientic.com/index.php?endpoint=table_sensor

**Body:**

```json
{
  "tableId": 1
}

```
### Respuesta:

```json
[
    {
        "id": 1,
        "id_table": 1,
        "id_sensor": 2
    },
    {
        "id": 2,
        "id_table": 1,
        "id_sensor": 2
    },
    {
        "id": 3,
        "id_table": 1,
        "id_sensor": 2
    }
]
```
## Relaciones en base de datos
![image](https://github.com/user-attachments/assets/1b028989-adb2-420d-b5b9-7bb49a65c59a)
