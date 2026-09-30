FROM php:8.2-apache

# Activar mod_rewrite de Apache por si usas rutas amigables
RUN a2enmod rewrite

# Instalar extensiones necesarias para bases de datos (MySQL/MariaDB)
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiar todos los archivos del proyecto al servidor web
COPY . /var/www/html/

# Asignar permisos
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
