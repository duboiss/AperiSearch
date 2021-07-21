# AperiSearch

## Description
This repository allows to test [MeilISearch](https://www.meilisearch.com/) (search engine API) with [doctrine entity listeners](https://symfony.com/doc/current/doctrine/events.html#doctrine-entity-listeners) on Symfony.

![AperiSearch](aperisearch.png)

## Requirements
- PHP 8 and [composer](https://getcomposer.org/)
- Docker

## Instructions
```sh
docker-compose up -d
composer install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load --no-interaction

php -S 127.0.0.1:8000 -t public
```
Open [http://localhost:8000](http://localhost:8000) for the website and [http://localhost:7700/](http://localhost:7700) for the web interface of MeiliSearch.

## Usage
You can CRUD users on [http://localhost:8000/user](http://localhost:8000/user) to see updates of the MeiliSearch engine.

## Movies
If you want to try with larger data you can use the `movies.json` file in the root folder.
Import data with a POST http call.

Exemple with [curl](https://github.com/curl/curl) and [httpie](https://github.com/httpie/httpie):
```sh
curl -X POST 'http://localhost:7700/indexes/movies/documents' --data @movies.json
# or
http POST http://localhost:7700/indexes/movies/documents < movies.json
```
Think to change meilisearch index (`movies` instead of `users`) and the attribute template (`pseudo` instead of `title`) in `templates/page/index.html.twig`.
