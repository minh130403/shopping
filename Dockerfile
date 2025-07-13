FROM php:8.2

# Cài các package Laravel cần, PostgreSQL, Node.js và các lib để build GD
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev gnupg \
    libjpeg-dev libfreetype6-dev libwebp-dev libxpm-dev \
    # Cài Node.js 18
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    # Cấu hình và cài GD extension cùng các extension khác
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd pdo_pgsql pgsql pdo_mysql zip exif pcntl bcmath

# ✅ Tăng giới hạn bộ nhớ PHP lên 512MB
RUN echo "memory_limit=512M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www

# Copy toàn bộ mã nguồn Laravel
COPY . .

# Copy script khởi động
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Cài Composer dependencies (sản phẩm, không cần dev)
RUN composer install  --optimize-autoloader

# Cài npm packages + build Vite
RUN npm install && npm run build

# Phân quyền cho storage & cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Mở cổng Laravel sử dụng (mặc định là 8080 nếu dùng php artisan serve)
EXPOSE 8080

# Dùng script entrypoint
ENTRYPOINT ["/entrypoint.sh"]
