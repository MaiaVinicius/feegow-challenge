#!/bin/bash

chmod -R 777 storage

composer install

php artisan key:generate

php artisan config:cache

php artisan migrate


php-fpm
