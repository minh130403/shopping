#!/bin/bash

set -e

echo "📦 Running migrations..."

php artisan config:clear
php artisan config:cache
# php artisan migrate:fresh --seed --force


php artisan storage:link || true

echo "🚀 Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}

