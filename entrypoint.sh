#!/bin/sh

echo "📦 Caching config..."
php artisan config:clear

echo "🔄 Migrating database (fresh + seed)..."
php artisan migrate:fresh --seed --force

echo "🚀 Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
