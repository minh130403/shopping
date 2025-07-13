#!/bin/bash

set -e

echo "📦 Running migrations..."
# php artisan migrate --force
php artisan config:clear
php artisan config:cache

echo "🚀 Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
