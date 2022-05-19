#!/bin/bash

php artisan jetstream:install livewire
php artisan orchid:install
# creacion de usuario
# php artisan orchid:admin admin admin@admin.com password

# permitir imagenes
php artisan storage:link

