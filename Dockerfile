FROM php:8.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

RUN sed -ri 's!AllowOverride None!AllowOverride All!g' \
    /etc/apache2/apache2.conf

RUN sed -ri 's!Listen 80!Listen 10000!g' \
    /etc/apache2/ports.conf \
    && sed -ri 's!<VirtualHost \*:80>!<VirtualHost *:10000>!g' \
    /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

EXPOSE 10000

CMD ["apache2-foreground"]