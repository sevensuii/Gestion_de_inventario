#!/bin/bash

php artisan jetstream:install livewire
php artisan orchid:install
# creacion de usuario
# php artisan orchid:admin admin admin@admin.com password
# php artisan orchid:admin Manolo pruebas@pruebas.com csas1234

# permitir imagenes
php artisan storage:link

# Publicar todos los componentes de livewire
php artisan vendor:publish --tag=jetstream-views

