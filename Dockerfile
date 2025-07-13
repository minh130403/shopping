FROM php:8.2

# Cài các package Laravel cần + PostgreSQL + Node.js
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev gnupg \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql zip exif pcntl bcmath \
    # Cài Node.js 18
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ mã nguồn
COPY . .

# Copy script khởi động
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cài Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Cài npm dependencies + build Vite
RUN npm install && npm run build

# Phân quyền thư mục storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng Laravel sử dụng
EXPOSE 8080

# Dùng entrypoint script để migrate và start server
ENTRYPOINT ["/entrypoint.sh"]
