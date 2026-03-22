FROM php:8.2-apache
RUN docker-php-ext-install mysqli
ENV PORT=80
EXPOSE 80
COPY . /var/www/html/
