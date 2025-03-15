# Use PHP-FPM base image
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y nginx supervisor unzip git curl

# Set working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Expose necessary ports
EXPOSE 80 9000

# Copy Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Start PHP-FPM and Nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
