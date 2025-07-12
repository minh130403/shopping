FROM php:8.2

# Cài các package Laravel cần + PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql zip exif pcntl bcmath

# Cài composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy source
COPY . .

# Cài Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Phân quyền
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng HTTP
EXPOSE 8080

# Khởi chạy Laravel HTTP server
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$PORT"]
