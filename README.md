# Demo project for asynchronous API requests
This project demonstrates an approach for calling multiple APIs asynchronously in a 
Controller-Service-Repository architecture.

The `/sync` laravel endpoint calls the APIs synchronously, the `/async`endpoint does the same asynchronously.

## Starting APIs
Because of the sleep commands in each API you need to start a PHP process for each API endpoint.

```
sh api/start.sh 8080
sh api/start.sh 8081
sh api/start.sh 8082
```

## Starting laravel app
```
cd webapp
php artisan serve
```