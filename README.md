Instrucciones para el Despliegue de la Prueba Técnica

a continuación detallo las instrucciones necesarias para el despliegue de la prueba técnica.

1 Repositorio del Proyecto
El proyecto está disponible en el repositorio de Git que se adjunta.

https://github.com/YonfrediGonzalez/boom.git

2 Base de Datos
La base de datos se encuentra en la carpeta llamada "Base de datos". Es necesario importar esta base de datos en su equipo utilizando herramientas de preferencia como XAMPP, Laragon, WAMP, etc.

-Desde phpMyAdmin, importe la base de datos y asígnele el nombre "boom" o el que prefiera. Asegúrese de que este nombre esté correctamente configurado en el archivo de configuración del proyecto.

3 Configuración del Proyecto

-Configure la base de datos en el archivo .env del proyecto. A continuación, se muestra un ejemplo de la configuración necesaria:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=boom
DB_USERNAME=root
DB_PASSWORD=
Inicio de Sesión y Roles

Una vez iniciado el sistema, podrá registrar usuarios. Por defecto, los usuarios registrados tendrán el rol de "user". Si desea ingresar como administrador, utilice las siguientes credenciales

Usuario: fredgontorres@gmail.com
Contraseña: Prueba2025*

Estos datos se encuentran en la base de datos, y el sistema validará esta información para ingresar como administrador. Al ingresar, podrá ver el nombre del usuario y su rol (en este caso, Admin).
Gestión de Tareas

Los usuarios pueden crear tareas individuales, asignándoles una fecha de entrega o vencimiento. Este campo está validado para que no se pueda establecer una fecha anterior al día actual.

Al crear una tarea, se mostrará en una tabla donde podrá:

Completar la tarea
Editar la tarea
Eliminar la tarea (con alertas emergentes)
La tabla incluye tres botones de filtro para visualizar:

Tareas completadas
Tareas no completadas
Todas las tareas
Además, se incluye un script que permite buscar por cualquie
