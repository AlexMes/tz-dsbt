# Installation
For correct installation on your server must be installed php 7.x, MySql;

- Clone project to local machine
```bash
git clone https://github.com/AlexMes/cpn.git
```

- create database and make changes in .env
- run command
```bash
composer update
php artisan migrate
php artisan key:generate
php artisan db:seed - не реализовано
php artisan orchid:admin admin admin@admin.com password
Добавить язык в панели управления
```
