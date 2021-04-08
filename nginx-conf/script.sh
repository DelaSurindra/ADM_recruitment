#!/usr/bin/env bash

#cp /var/www/html/.env.example /var/www/html/.env
chmod 777 -R /var/www/html/
#php artisan key:generate --force
php artisan cache:clear
php artisan config:clear
php artisan storage:link
# php artisan migrate:fresh --seed
service nginx start
php-fpm
