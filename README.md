# Movies directory

## Introducción

He optado por realizar la prueba técnica con el framework [Symfony 6.4.5](https://symfony.com/doc/6.0/index.html) el cual es la LTS a día de escribir este documento.

He considerado que Symfony es una buena opción para crear una aplicación web y también de consola.

## Instrucciones para poner en marcha la aplicación

### Requisitos mínimos de la instalación

- Docker v25.0.4 o superior
- Docker compose v2.24 o superior

### Puesta en marcha
La primera vez para levantar y construir los contenedores ejecutamos en la raíz del proyecto:

```bash
docker compose up -d --build
```

Si se apaga el ordenador, se tiran abajo los contenedores o no se modifican los `Dockerfile`, se levanta con:

```bash
docker compose up -d
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

Para filtrar por los diferentes criterios que se requieren en la prueba técnica, he añadido unos enlaces de ejemplo en http://127.0.0.1:8000/movies#examples

El filtrado se realiza por los siguientes `querystrings`:

- `title_starts_with`
- `title_ends_with`
- `title_contains`
- `year`
- `rating_greater_or_equal`
- `rating_less_or_equal`

### Aplicación de consola

Se puede ejecutar dentro del contenedor de docker en la ruta `/var/www/symfony`:

```bash
php bin/console app:movies
```

Para ver las opciones disponibles hay que ejecutar:

```bash
php bin/console help app:movies
```

Varios ejemplos de uso para filtrar en el catálogo de peliculas:

```bash
php bin/console app:movies --title_starts_with='The '
php bin/console app:movies --title_ends_with='s'
php bin/console app:movies --title_contains='Ring'
php bin/console app:movies --year=2000
php bin/console app:movies --rating_greater_or_equal=8
php bin/console app:movies --rating_less_or_equal=7
```

### Tests unitarios

Los test unitarios se ejecutan dentro del contenedor de docker en la ruta `/var/www/symfony`:

```bash
php bin/phpunit
```


### Implementaciones que hubiera hecho al disponer de mas tiempo

Tanto en la web como en la aplicación de consola, los filtros solo se pueden usar individualmente. Al disponer de mas tiempo hubiera implementado un sistema de filtros el los que se pudieran combinar mas de un filtro a la vez. Por ejemplo: Un filtro que muestre las películas del año 1998 y que el título empiece por `The` y ademas su puntuación sea menor o igual a 6.

Por otro lado hubiera realizado mas tests unitarios y algunos de integración.



