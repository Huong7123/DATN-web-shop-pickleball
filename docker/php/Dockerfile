FROM php:8.2-fpm

# Cài các thư viện cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl && \
    docker-php-ext-install pdo pdo_mysql gd && \
    docker-php-ext-enable pdo_mysql

# Cài Composer (thêm đoạn này)
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Đặt thư mục làm việc
WORKDIR /var/www/html
