#!/bin/bash

php artisan serve --host 0.0.0.0
php artisan websockets:serve --host 0.0.0.0
