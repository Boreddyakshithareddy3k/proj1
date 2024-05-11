FROM php:apache

# Install PDO MySQL and MySQLi extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Install MySQL client (not needed for PDO)
# RUN apt-get update && apt-get install -y default-mysql-client

# Set up PHP with Apache
COPY . /var/www/html/
WORKDIR /var/www/html

# Expose port 80 (Apache) 
EXPOSE 80

# Start Apache only, MySQL will be accessed via container network
CMD ["apache2-foreground"]
