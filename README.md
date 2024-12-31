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
`POST` [http://tu-servidor/index.php?endpoint=login](http://tu-servidor/index.php?endpoint=login)

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
