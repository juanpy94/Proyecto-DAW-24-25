# 🚗 Sistema de Gestión y Organización de Taller Mecánico

Aplicación web desarrollada como proyecto final del Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Web (DAW).

El proyecto consiste en una plataforma para la gestión integral de un taller mecánico, permitiendo administrar clientes, vehículos y maquinaria, reparaciones, categorías, facturas y usuarios con diferentes niveles de acceso.

La aplicación ha sido desarrollada utilizando Laravel y PHP como tecnologías principales, junto con una base de datos MySQL y tecnologías frontend como HTML, CSS y JavaScript.

## 📌 Descripción

El objetivo del proyecto es digitalizar y centralizar la gestión y organización de un taller mecánico.

La aplicación permite controlar el proceso completo de una reparación, desde que se registra el vehículo o maquinaria de un cliente y se crea una reparación, hasta que el trabajo es realizado por el mecánico, se genera la factura y finalmente se registra su cobro.

El sistema cuenta con diferentes perfiles de usuario, cada uno con funcionalidades y permisos específicos:

- Cliente
- Jefe de taller
- Mecánico
- Administrativo
- Administrador

El acceso a las diferentes funcionalidades está protegido mediante autenticación y control de roles.

## ✨ Funcionalidades principales

### 🔐 Autenticación y usuarios

- Registro de nuevos usuarios.
- Inicio y cierre de sesión.
- Verificación del correo electrónico.
- Recuperación y restablecimiento de contraseña.
- Edición del perfil.
- Cambio de contraseña.
- Eliminación de la cuenta.
- Control de acceso mediante autenticación.
- Gestión de diferentes roles de usuario.

### 👤 Cliente

El cliente puede gestionar la información relacionada con sus vehículos y reparaciones y ver las reparaciones y sus correspondientes facturas.

Entre sus funcionalidades se encuentran:

- Consultar sus vehículos y maquinarias.
- Añadir nuevos vehículos o maquinarias.
- Editar sus vehículos o maquinarias.
- Eliminar vehículos o maquinarias.
- Consultar sus reparaciones.
- Consultar sus facturas.
- Visualizar sus facturas en PDF.
- Acceder a información de ayuda específica para su perfil.

### 🔧 Jefe de taller

El jefe de taller se encarga principalmente de gestionar las reparaciones y organizar el trabajo del taller.

Puede:

- Consultar las reparaciones asignadas.
- Crear nuevas reparaciones.
- Asignar reparaciones a mecánicos.
- Buscar clientes y consultar sus vehículos.
- Editar reparaciones.
- Eliminar reparaciones.
- Consultar las reparaciones que se encuentran en proceso.
- Gestionar las categorías de reparación.
- Crear nuevas categorías.
- Editar categorías.
- Eliminar categorías.

### 🛠️ Mecánico

El mecánico dispone de las herramientas necesarias para gestionar el proceso de reparación.

Puede:

- Consultar las reparaciones que tiene asignadas.
- Iniciar una reparación.
- Gestionar reparaciones en proceso.
- Cancelar o devolver una reparación a su estado anterior.
- Completar una reparación.
- Añadir los detalles y trabajos realizados.
- Consultar las reparaciones completadas.

### 🧾 Administrativo
El usuario administrativo se encarga principalmente de la gestión de facturas.

Puede:

- Consultar reparaciones pendientes de facturación.
- Crear facturas.
- Añadir precios, IVA y descuentos.
- Consultar facturas.
- Buscar facturas por cliente.
- Visualizar facturas en PDF.
- Editar facturas.
- Gestionar facturas pendientes de pago.
- Registrar el cobro de facturas.
- Consultar las facturas completadas.

### ⚙️ Administrador

El administrador dispone de acceso a la gestión global de la aplicación.

Puede gestionar:

- Usuarios.
- Categorías.
- Vehículos y maquinarias.
- Reparaciones.
- Detalles de reparaciones.
- Facturas.
- Configuración de las facturas.

También dispone de funcionalidades de búsqueda y edición para facilitar la administración de los diferentes elementos del sistema.

## 🛠️ Tecnologías utilizadas

### ⚙️ Backend

- 🐘 PHP
- 🚀 Laravel

### 🎨 Frontend

- 🌐 HTML5
- 🎨 CSS3
- 🅱️ Bootstrap
- ⚡ JavaScript

### 🗄️ Base de datos

- 🐬 MySQL
- 🔄 Laravel Migrations
- 🌱 Laravel Seeders

### 📄 Generación de documentos

- 📑 Dompdf — Generación de facturas en formato PDF.

### 🧰 Herramientas

- 🌿 Git
- 🐙 GitHub
- 💻 Visual Studio Code
- 📦 Composer
- 📦 npm

## 🏗️ Arquitectura

El proyecto utiliza la arquitectura proporcionada por Laravel, siguiendo el patrón MVC (Model-View-Controller).

La estructura principal del proyecto es:

```text
Proyecto-DAW-24-25/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   └── views/
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

Las rutas de la aplicación están organizadas según las diferentes funcionalidades y roles, utilizando middleware para restringir el acceso a las secciones correspondientes.

## 🔒 Control de acceso

Uno de los aspectos principales del proyecto es la separación de funcionalidades mediante roles de usuario.

Los roles implementados son:

| Rol | Función principal |
|---|---|
| 👤 **Cliente** | Gestión de vehículos, reparaciones y facturas propias |
| 🔧 **Jefe de taller** | Gestión y asignación de reparaciones |
| 🛠️ **Mecánico** | Gestión del proceso de reparación |
| 🧾 **Administrativo** | Gestión y cobro de facturas |
| ⚙️ **Administrador** | Gestión global del sistema |

Las rutas correspondientes a cada perfil están protegidas mediante middleware de roles, evitando que un usuario pueda acceder directamente a funcionalidades que no le corresponden.

## 📄 Facturación

El sistema incluye un módulo completo para la gestión de facturas.

El flujo principal es:

```text
Reparación
    │
    ▼
Reparación completada
    │
    ▼
Creación de factura
    │
    ▼
Aplicación de precios, IVA y descuentos
    │
    ▼
Factura generada
    │
    ▼
Factura en PDF
    │
    ▼
Cobro de factura
```

Las facturas pueden ser consultadas y generadas en formato PDF mediante la librería Dompdf. El proyecto incluye rutas específicas tanto para el personal administrativo como para los clientes.

## 📋 Requisitos

Para ejecutar el proyecto localmente es necesario disponer de:

- PHP 8.1 o superior
- Composer
- MySQL
- Node.js y npm
- Git

El proyecto utiliza Laravel 10 y requiere PHP 8.1 o superior según las dependencias definidas en composer.json

En proceso...









<!--

⚙️ Instalación
1. Clonar el repositorio

git clone https://github.com/juanpy94/Proyecto-DAW-24-25.git

Entrar en la carpeta del proyecto:

cd Proyecto-DAW-24-25

2. Instalar las dependencias de PHP
composer install

3. Instalar las dependencias de JavaScript
npm install

4. Configurar el archivo .env
Copiar el archivo de configuración de ejemplo:

cp .env.example .env

En Windows también se puede copiar manualmente .env.example y renombrarlo como .env.

Después, configurar los datos de conexión a la base de datos.

Por ejemplo:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=root
DB_PASSWORD=

El proyecto está configurado para utilizar MySQL en el archivo .env.example

5. Generar la clave de la aplicación
php artisan key:generate

6. Crear la base de datos
Crear una base de datos MySQL para el proyecto.

Por ejemplo:

CREATE DATABASE proyecto_daw;

Después, indicar el nombre de la base de datos en el archivo .env:

DB_DATABASE=proyecto_daw

7. Ejecutar las migraciones
php artisan migrate

Si el proyecto dispone de datos iniciales mediante seeders:

php artisan migrate --seed

8. Crear el enlace de almacenamiento
php artisan storage:link

9. Compilar los recursos frontend
Para desarrollo:

npm run dev

Para generar los recursos optimizados:

npm run build

El proyecto utiliza Vite para la gestión y compilación de los recursos frontend

10. Ejecutar la aplicación
En otra terminal:

php artisan serve

La aplicación estará disponible normalmente en:

http://127.0.0.1:8000

🚀 Puesta en marcha rápida
Una vez configurado el proyecto, el flujo habitual para trabajar en desarrollo es:

composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run dev

Y en otra terminal:

php artisan serve

🧪 Tests
El proyecto incluye configuración para realizar pruebas mediante PHPUnit, utilizando las herramientas de testing proporcionadas por Laravel. 
G
GitHub

Para ejecutar las pruebas:
php artisan test


📸 Capturas de pantalla

💡 Añade aquí capturas reales de tu aplicación. Esta sección es especialmente recomendable si utilizas este repositorio como portfolio.

Página principal
Inicio de sesión
Panel del cliente
Gestión de reparaciones
Gestión de facturas
Factura en PDF

📚 Contexto académico

Este proyecto fue desarrollado durante el Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Web (DAW).

Durante el desarrollo se han aplicado conocimientos relacionados con:

Desarrollo backend.

Desarrollo frontend.

Bases de datos relacionales.

Arquitectura MVC.

Programación orientada a objetos.

Autenticación y autorización.

Gestión de sesiones.

Validación de formularios.

CRUD.

Gestión de roles y permisos.

Generación de documentos PDF.

Migraciones y seeders.

Gestión de dependencias.

Control de versiones con Git.

Desarrollo de aplicaciones web con Laravel.

👨‍💻 Autor
Juan

Proyecto desarrollado como parte del Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Web (DAW).

GitHub:

https://github.com/juanpy94

📄 Licencia
Este proyecto ha sido desarrollado con fines académicos y como muestra de aprendizaje y desarrollo de aplicaciones web.

-->



