## Local Environment

Requires:
* Docker & Docker Compose
* PHP >= 8.1 and composer

### Laravel & PHP

Create `.env` file copy code from `.env.example` file.

Run `composer install` to download the Laravel dependencies.

### Docker Containers

Run `docker-compose build` to build the app container images. Then run `docker-compose up -d` to start the local environment in the background. To stop the docker setup run
`docker-compose down`.

### Migrating

* databases created:*
```
DB_DATABASE=avrillo
```
`avrillo` is MYSQL database
`avrillo_test` needs to be created if running testcase with phpunit.xml as configure file

```sh
docker-compose exec app php artisan migrate
```

### Api Access
Run command to create an api access key for frontend, copy the generated token to .env file of frontend
```sh
docker-compose exec app php artisan api-access:create
```

### Testing

To run the tests you can call `vendor/bin/phpunit` which will call the phpunit installed through composer.

```shell 
docker-compose exec app vendor/bin/phpunit
```

