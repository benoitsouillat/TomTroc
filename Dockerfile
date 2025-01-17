FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zlib1g-dev\
    libzip-dev \
    libicu-dev \
    g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl mysqli pdo pdo_mysql
RUN chmod -R 775 '/var/www/html'

WORKDIR "/var/www/html"

EXPOSE 80

CMD ["apache2-foreground"]