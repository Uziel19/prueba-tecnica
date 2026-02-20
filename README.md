# Prueba Técnica - API de Usuarios

API desarrollada en **Laravel 9 + MySQL** con **Sanctum** para tokens de 5 minutos. Los datos sensibles se encriptan con **AES-256-CBC**.

## Repositorio
[https://github.com/Uziel19/prueba-tecnica.git](https://github.com/Uziel19/prueba-tecnica.git)

## Usuario de prueba
- **Usuario:** `testuser`
- **Contraseña:** `password123`

> Ya viene creado para que puedas probar la API directamente.

## Qué puedes hacer
- `GET /api/token` → obtener token de sesión  
- `POST /api/users` → crear un usuario  
- `PUT /api/users/{id}` → actualizar un usuario  
- `DELETE /api/users/{id}` → eliminar un usuario  
- `POST /api/users/{id}/cards` → registrar una tarjeta para un usuario  

## Cómo probarlo
1. Clona el proyecto y entra en la carpeta:
`git clone https://github.com/Uziel19/prueba-tecnica.git && cd prueba-tecnica`

2. Ejecuta migraciones y carga el usuario de prueba:
`php artisan migrate && php artisan db:seed`

3. Inicia el servidor:
`php artisan serve`

4. Abre en tu navegador o cliente de API: `http://localhost:8000`  
y prueba los endpoints usando `testuser`.

## Autor
**Edgar Usiel Guzman Estrella**
