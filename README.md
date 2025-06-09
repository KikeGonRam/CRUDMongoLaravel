# Proyecto Laravel con MongoDB

Este proyecto implementa un sistema CRUD (Crear, Leer, Actualizar, Eliminar) completo para **Productos**, **Usuarios** y **Carros**, utilizando Laravel y MongoDB como base de datos.

## 📌 Requisitos

- PHP 8.x
- Composer
- Laravel 10.x
- MongoDB
- Extensión MongoDB para PHP

## 🚀 Instalación

1. Clona el repositorio:
   ```sh
   git clone https://github.com/usuario/proyecto-laravel-mongodb.git
   cd proyecto-laravel-mongodb
   ```

2. Instala las dependencias:
   ```sh
   composer install
   ```

3. Configura el archivo `.env` con las credenciales de MongoDB:
   ```env
   DB_CONNECTION=mongodb
   DB_HOST=127.0.0.1
   DB_PORT=27017
   DB_DATABASE=nombre_basedatos
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

4. Ejecuta los seeders para poblar la base de datos:
   ```sh
   php artisan migrate:fresh --seed
   ```

## 📂 Estructura del Proyecto

```
├── app/
│   ├── Models/
│   │   ├── Producto.php
│   │   ├── Usuario.php
│   │   ├── Carro.php
│   ├── Controllers/
│   │   ├── ProductoController.php
│   │   ├── UsuarioController.php
│   │   ├── CarroController.php
│   ├── Providers/
│   ├── ...
├── routes/
│   ├── web.php
│   ├── api.php
├── database/
│   ├── seeders/
│   │   ├── ProductoSeeder.php
│   │   ├── UsuarioSeeder.php
│   │   ├── CarroSeeder.php
├── public/
│   ├── imagen3.png
│   ├── imagen2.png
└── ...
```

## 🔥 CRUD Endpoints

### Productos
- `GET /productos` - Listar productos
- `GET /productos/{id}` - Obtener un producto específico
- `POST /productos` - Crear un producto
- `PUT /productos/{id}` - Actualizar un producto
- `DELETE /productos/{id}` - Eliminar un producto

### Usuarios
- `GET /usuarios`
- `GET /usuarios/{id}`
- `POST /usuarios`
- `PUT /usuarios/{id}`
- `DELETE /usuarios/{id}`

### Carros
- `GET /carros`
- `GET /carros/{id}`
- `POST /carros`
- `PUT /carros/{id}`
- `DELETE /carros/{id}`

## 🌟 Ejemplo de Imágenes

Aquí hay ejemplos de imágenes utilizadas en el proyecto:

![Ejemplo Imagen 1](public/imagen3.png)
![Ejemplo Imagen 2](public/imagen2.png)

## 🛠️ Uso

Para iniciar el servidor:
```sh
php artisan serve
```

## 📌 Contribuir

Si deseas contribuir, envía un PR con mejoras o nuevas características.

## 📜 Licencia

Este proyecto está bajo la licencia MIT.

---

¡Espero que este `README.md` sea útil para tu proyecto! 🚀 Si necesitas más detalles o ajustes, dime. 😊
