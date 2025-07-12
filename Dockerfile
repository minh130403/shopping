FROM php:8.2

# Cài các package cần thiết
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath

# Cài composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ mã nguồn vào container
COPY . .

# Cài dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở port cho Render
EXPOSE 8080

# Laravel sẽ serve qua HTTP (phải dùng sh để biến $PORT được phân tích)
CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=$PORT"]
