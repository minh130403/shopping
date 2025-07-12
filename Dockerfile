# Sử dụng image PHP chính thức có sẵn
FROM php:8.2-fpm

# Cài các package cần thiết
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www

# Copy mã nguồn
COPY . .

# Cài các dependency PHP
RUN composer install

# Phân quyền cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng (nếu dùng php-fpm hoặc muốn test trực tiếp)
EXPOSE 9000

# Khởi động PHP-FPM
CMD ["php-fpm"]
