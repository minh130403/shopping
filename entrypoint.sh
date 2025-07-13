#!/bin/bash

set -e

echo "📦 Running migrations..."
php artisan db:seed
php artisan config:clear
php artisan config:cache

php artisan storage:link || true

echo "🚀 Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}

