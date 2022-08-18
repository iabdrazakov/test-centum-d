<p align="center">
<img height="80" src="https://laravel.com/img/logomark.min.svg">
</p>

#### This is a REST api service, that utilises Laravel.

## Extensions

- BackEnd: [Laravel 9](https://laravel.com/)

## Install
- `git clone git@github.com:iabdrazakov/test-centum-d.git`
- `cp .env.example .env` - init .env file
- `docker-compose up -d --build` - build and run containers
- `docker-compose exec app composer install` - install php dependencies
- `docker-compose exec app php artisan key:generate`
- entry point: [http://127.0.0.1:8080/](http://127.0.0.1:8080/)

## Code Style

Backend  rules with a description and explanation(PSR2) - https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.18/doc/ruleSets/PSR2.rst

## Testing

### Unit Testing
`docker-compose exec app php artisan test`
