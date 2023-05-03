# Backend - EveryWorkflow

EveryWorkflow implementation of Symfony Backend.


Version: Under Development `dev-main`


## Project setup

- Install symfony-dev-docker from https://github.com/readymadehost/symfony-dev-docker
- `git clone https://github.com/everyworkflow/backend.git project`
- For docker setup use: `cp project/symfony-dev-docker/.env ./.env`
- `cp project/symfony-dev-docker/docker-compose.yml ./docker-compose.yml`
- Make sure docker is configured to use php8.2 and mongodb enabled
- `docker-compose build` to build containers
- `docker-compose up -d` to spin up development containers
- `docker-compose ps` to check status of development containers
- `docker-compose exec cli bash` to get inside cli container
- `cp .env.sample .env`
- `composer install` to install composer dependencies
- `bin/console lexik:jwt:generate-keypair` to generate JWT keypair
- `bin/console mongo:database:drop` to drop database
- `bin/console mongo:migrate` to migrate mongo migrations
- `bin/console mongo:sync` to sync mongo indexes
- `mpp` to run `/root/manage-project-permission.sh`


## Seeder

```
bin/console mongo:seed "EveryWorkflow\AdminPanelBundle\Seeder\Mongo_2023_01_01_00_00_00_Basic_Seeder"
bin/console mongo:seed "EveryWorkflow\EcommerceBundle\Seeder\Mongo_2023_01_01_00_00_00_Ecommerce_Seeder"
```

```
bin/console mongo:seed:rollback -c "EveryWorkflow\AdminPanelBundle\Seeder\Mongo_2023_01_01_00_00_00_Basic_Seeder"
bin/console mongo:seed:rollback -c "EveryWorkflow\EcommerceBundle\Seeder\Mongo_2023_01_01_00_00_00_Ecommerce_Seeder"
```


## Swagger UI

- http://localhost:8080/swagger


## Tests

#### Running symfony tests

- `bin/console --env=test mongo:database:drop`
- `bin/console --env=test mongo:migrate`
- `bin/phpunit`

#### Generating code coverage

- `XDEBUG_MODE=coverage bin/phpunit --coverage-html public/test-html`
- Visit: http://localhost:8080/test-html/index.html


## Quick links

- https://symfony.com
- https://twig.symfony.com
- https://docs.mongodb.com/php-library
- https://carbon.nesbot.com

