# zaiko

"zaiko" is a simulation of an inventory management system using php

# DEMO

You can learn to register and edit inventory
Gain basic skills for creating inventory management simulations.

# Features

The permissions that can be changed by logged-in users are different, making management easier

# Requirement

PHP 7.4.27 
Laravel Framework 6.20.44

# Installation
If you are a mac user

Please enter in the terminal as follows

docker-compose up -d

docker-compose exec app bash

composer create-project --prefer-dist laravel/laravel=6.0.* ./

composer install

composer update

php artisan key:generate

chmod 777 -R storage

chmod 777 bootstrap/cache

# Usage

By registering new stock, you can change the order status, change the price and quantity with this system.

# Note

Since only three user permissions, user ID 1, 2, and 3, are prepared, it may be necessary to edit the permissions.

# Author


*　takuto osawa

# License

"zaiko" is Confidential.
