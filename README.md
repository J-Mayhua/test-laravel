# API de Gestión de Productos y Categorías - Laravel Backend

## Descripción
API REST desarrollada con Laravel 11 para gestión completa de productos y categorías. Incluye documentación Swagger, observabilidad con Telescope y auditoría con Spatie Activity Log.

## Requisitos Previos
- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## Instalación

### 1. Clonar el repositorio
git clone <url-del-repositorio>
cd laravel-api

### 2. Instalar dependencias
composer install

### 3. Configurar variables de entorno
cp .env.example .env
php artisan key:generate

### 4. Configurar base de datos
Edita el archivo .env con tus credenciales de MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

### 5. Ejecutar migraciones y seeders
php artisan migrate --seed

### 6. Generar documentación Swagger
php artisan l5-swagger:generate

### 7. Iniciar el servidor
php artisan serve

## URLs de Acceso
- API Base: http://127.0.0.1:8000/api
- Documentación Swagger: http://127.0.0.1:8000/api/documentation
- Laravel Telescope: http://127.0.0.1:8000/telescope

## Endpoints de la API

### Categorías
- GET /api/categories - Listar todas las categorías
- POST /api/categories - Crear nueva categoría
- GET /api/categories/{id} - Obtener categoría específica
- PUT /api/categories/{id} - Actualizar categoría
- DELETE /api/categories/{id} - Eliminar categoría

### Productos
- GET /api/products - Listar todos los productos
- POST /api/products - Crear nuevo producto
- GET /api/products/{id} - Obtener producto específico
- PUT /api/products/{id} - Actualizar producto
- DELETE /api/products/{id} - Eliminar producto

## Formato de Respuesta
Todas las respuestas siguen el formato JSON estándar:

Respuesta exitosa:
{
  "success": true,
  "message": "Operación realizada correctamente",
  "data": { ... }
}

Respuesta de error:
{
  "success": false,
  "message": "Descripción del error",
  "errors": {
    "campo": ["Mensaje de error específico"]
  }
}

## Estructura del Proyecto
laravel-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── CategoryController.php
│   │   │   └── ProductController.php
│   │   └── Requests/
│   │       ├── StoreCategoryRequest.php
│   │       ├── UpdateCategoryRequest.php
│   │       ├── StoreProductRequest.php
│   │       └── UpdateProductRequest.php
│   └── Models/
│       ├── Category.php
│       └── Product.php
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
├── storage/
│   └── api-docs/
│       └── api-docs.json
├── .env.example
├── composer.json
└── README.md

## Características Implementadas
- CRUD completo de Categorías y Productos
- Validación de datos con FormRequest
- Auditoría con Spatie Activity Log
- Documentación API con Swagger/OpenAPI
- Observabilidad con Laravel Telescope
- Formato JSON estándar en todas las respuestas
- Relaciones Eloquent entre modelos
- Principio de Responsabilidad Única (SRP)

## Manejo de Errores
- 404: Recurso no encontrado
- 422: Error de validación
- 500: Error interno del servidor

Todos los errores devuelven JSON con el formato estándar.

## Tecnologías Utilizadas
- Laravel 11
- MySQL
- Swagger/OpenAPI (l5-swagger)
- Laravel Telescope
- Spatie Activity Log
