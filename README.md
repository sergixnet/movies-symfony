# Movies directory

## Introducción

He optado por realizar la prueba técnica con el framework [Symfony 6.4.5](https://symfony.com/doc/6.0/index.html) el cual es la LTS a día de escribir este documento.

He considerado que Symfony es una buena opción para crear una aplicación web o de consola.

## Instrucciones para poner en marcha la aplicación

### Requisitos mínimos de la instalación

- Docker v25.0.4 o superior
- Docker compose v2.24 o superior

### Puesta en marcha
La primera vez para levantar y construir los contenedores ejecutamos en la raíz del proyecto:

```bash
docker-compose up -d --build
```

Si se apaga el ordenador, se tiran abajo los contenedores o no se modifican los `Dockerfile`, se levanta con:

```bash
docker-compose up -d
```

A continuación iniciamos una sesión de bash en el contenedor de PHP:

```bash
docker compose exec php bash
```

La primera vez instalaremos con `composer` los paquetes que requiere la instalación. Dentro de la sesión de bash:

```bash
composer install
```

Después levantamos el servidor web con:

```bash
symfony server:start -d
```
Si abrimos la URL http://127.0.0.1:8000 en un navegador veremos una web que indica la versión de Symfony.


### Aplicación web

La aplicación web se encuentra en la URL http://127.0.0.1:8000/movies



