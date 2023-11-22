# DESPLIEGE WEB
## SYMFONY CON DOCKER
### Descripción
Este proyecto consiste en la composición de una API con Symfony a través de Docker.
**Todo esto ha sido realizado con las tecnologías nginx,php y mysql. Para realizarlo ha sido necesario levantar un docker con estos servicios.**
### Docker 
Gracias al archivo ***docker-compose.yml***, ***Dockerfile*** y ***default.conf(solo para nginx)***(Estos archivos nos permiten imprementar los servicios de nginx,php y mysql en nuesto contenedor de docker) podemos levantar nuestro contenedor docker con el siguiente comando:
```
docker-compose up -d
```
__Es importante tener descargado docker y realizar este comando en el interior de la carpeta donde se encuentra docker-compose.yml__
### Estructura Symfony
El primer paso para trabajar en Symfony tras levantar docker es crear el esqueleto del proyecto.
```
composer create-project symfony/skeleton .
```
### Carpetas del proyecto
* nginx 
    - default.conf
    - Dockerfile 
    - config.php (Variables constantes sobre la base de datos utilizadas en todos los index)
* php
    - Dockerfile
    *** Dentro de estos elementos existen llamadas a la base de datos para realizar estos movimientos ***
* symfony
    - db.php (Clase de la bd con los métodos necesarios para la conexión con nuestra base de datos)
* .env(Guardado de las variables de MySQL)
* docker-compose.yml
```
 DATABASE_URL="mysql://root:secret@mysql:3306/db_symfony?serverVersion=8"
```
### Creacion de tablas en Symfony
El primer paso consiste en la creación de tablas, para ello es necesario introducirse en el interior del servicio de php donde se encuentra Symfony e introducir el siguiente código:
```
bin/console make:entity "nombre de la tabla"
```
A continuación te permitirá rellenar esta tabla, cuando esto acabe será necesario los ficheros migratorios y Symfony nos recomendará realizar los comandos necesarios para ello.
Nos permite generar los ficheros de migración de la BBDD
```
bin/console make:migration
```
Ejecuta los ficheros de migración de BBDD y crea tablas, campos etc
```
bin/console doctrine:migrations:migrate
```
### MOSTRAR, INSERTAR, ACTUALIZAR Y BORRAR REGRISTROS DE LA BASE DE DATOS 
En el fichero ***EstudianteController.php*** podemos encontrar los metodos para estos procesos:
* Es necesario declarar un método constructor para poder utilizarse en cada ruta.
* Funciones de mostrar con la ruta url de método get (en el caso de que le pases un id te mostrará uno solo sino mostrará toda la listas de estudiantes).
* Funciones de crear mediante la ruta post en la que podemos pasar los parámetros mediante postman para comprobarlo. Para esto debemos pasar el objeto estudiante mediante el Body de postman.
* Actualizar un registro mediante la ruta con método put junto a un id
En la clase ***EstudianteRepository.php*** podemos destacar el método que podemos utilizar cada vez que sea necesario mostrar un estudiante.
***Utilizo la tabla estudiante como ejemplo pero esto es aplicable a cualquier tabla***




