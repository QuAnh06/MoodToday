FROM php:8.2-apache

# Cài đặt các thư viện hệ thống
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Cài đặt PHP extensions cần cho Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Bật mod_rewrite của Apache (để chạy được các route Laravel)
RUN a2enmod rewrite

# Copy mã nguồn vào container
COPY . /var/www/html

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Phân quyền cho thư mục storage và cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Thiết lập cổng mặc định cho Render
ENV PORT 80
EXPOSE 80

# Cấu hình Apache trỏ vào thư mục public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf