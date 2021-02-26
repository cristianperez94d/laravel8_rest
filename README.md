<h1 align="center">LARAVEL8_REST</h1>

---

<p align="center"> 
  Ejemplo de un api rest usando laravel 8  
</p>

## 📝 Table of Contents


- [Getting Started](#getting_started)
- [Prerequisites](#prerequisites)


## Getting Started <a name = "getting_started"></a>

1. Crear la base de datos Mysql
2. Configurar el archivo .ENV para la base de datos
3. Ejecutar
```
composer install
```
4. Ejecutar migraciones y seeds para crear las tablas y alimentar la base de datos con datos de prueba
```
php artisan migrate --seed
```
5. Ejecutar lo siguiente para visualizar el resultado de forma local
```
php artisan serve
```
6. Endpoints 

- "http://127.0.0.1:8000/api/book/"
  Metodos GET, POST, DELETE


## Prerequisites <a name = "prerequisites"></a>

- Instalar Composer