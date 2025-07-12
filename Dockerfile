# Dùng image PHP
FROM php:8.2

# Cài các package Laravel cần
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath

# Cài composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set thư mục làm việc
WORKDIR /var/www

# Copy code vào container
COPY . .

# Cài dependency
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng để Render detect HTTP
EXPOSE 8080

# Laravel serve để Render nhận diện là web app
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT}"]
