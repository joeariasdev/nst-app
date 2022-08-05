# NST App

## Funcionalidades

- Agregar Editar usuarios
- Agregar, Editar Clientes
- Agregar Editar Dispositivos
- Administrar ordenes

## Instalación

Este proyecto fue construido con PHP atraves de Laravel Framwork

Versión de Laravel 9.22.1 Para mas informacion [Laravel](https://laravel.com/docs/9.x/releases).

Esta version Laravel requiere PHP 8.0

Primeramente debemos instalar la version de PHP 8.0+ [PHP](https://www.php.net/downloads.php)

Una vez clonado el repositorio debemos instalar los paquetes a traves de Composer.
Para mas informacion [Composer](https://getcomposer.org/doc/00-intro.md)

```sh
cd nst-app
composer install
```
Creamos la base de datos en el gestor Mysql con el nombre de su preferencia

Luego creamos el archivo .env a partir del archvo .env.example, agregamos los valores para referenciar la base de datos

```sh
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```

Luego debemos generar la llave de la aplicación, para eso haremos uso del siguiente comando

```sh
php artisan key:generate
```

Esta aplicacion requiere de [Node.js](https://nodejs.org/) v14+ para ejecutar y compilar los assets y estilos usados por defecto con laravel

```sh
npm install
```

Ahora se debe ejecutar las migraciones y poblar la base de datos con información de prueba, con el siguiente comando

```sh
php artisan migrate:fresh --seed
```

Por último para ejecutar la aplicación haremos uso de dos comandos, uno para compilar los haces en tiempo real y otro para levantar el servidor de la aplicación.

- En la terminal 1

```sh
npm run dev
```

- En la terminal 2

```sh
php artisan serve
```

El servidor se levanta por defecto en el puerto :8000, revisar si el puerto esta siendo utilizado por otro servicio

http://127.0.0.1:8000

Nota. para iniciar sesión, el correo es admin@admin.com, contraseña admin
