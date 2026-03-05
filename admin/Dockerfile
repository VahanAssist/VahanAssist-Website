FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Set the working directory to the Apache document root
WORKDIR /var/www/html

# Copy the application code into the container
COPY . /var/www/html/

# Ensure the upload and session directories are writable (adjust names if needed)
# RUN chown -R www-data:www-data /var/www/html/uploads
# RUN chmod -R 775 /var/www/html/uploads

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
