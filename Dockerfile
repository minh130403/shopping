FROM php:8.2

# Cài các package Laravel cần + PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql zip exif pcntl bcmath

# Cài composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Thư mục làm việc
WORKDIR /var/www

# Copy source code
COPY . .

# Copy entrypoint script
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cài Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Phân quyền
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng
EXPOSE 8080

# Dùng entrypoint để migrate và khởi động server
ENTRYPOINT ["/entrypoint.sh"]
