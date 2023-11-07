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
* .env
* docker-compose.yml