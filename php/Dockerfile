# Use the official PHP 8.2 FPM image as the base image
FROM php:8.2-fpm

# Install the PostgreSQL driver
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql 

# Set working directory
WORKDIR /var/www/html

# Copy the application files
COPY . .

# Expose port 9000 and start PHP-FPM server
EXPOSE 9000
CMD ["php-fpm"]
