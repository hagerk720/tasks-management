# Use the official PHP-FPM image  
FROM php:8.2-fpm  

# Install system dependencies  
RUN apt-get update && apt-get install -y \  
    libpng-dev \  
    libjpeg-dev \  
    libfreetype6-dev \  
    zip \  
    unzip \  
    git \  
    curl \  
    libonig-dev \  
    && docker-php-ext-configure gd \  
    && docker-php-ext-install pdo_mysql mbstring gd  

# Set working directory  
WORKDIR /var/www  

# Copy existing application  
COPY . .  

# Install Composer  
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer  
RUN composer install --no-dev --no-interaction --prefer-dist  

# Set permissions  
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache  

# Expose port 9000 for PHP-FPM  
EXPOSE 9000  

# Start PHP-FPM  
CMD ["php-fpm"]  
