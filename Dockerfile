FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita modulos necesarios de Apache
RUN a2enmod rewrite ssl

# Copia los archivos de la app principal
COPY ./src/app /var/www/app

# Copia los archivos de la API
COPY ./src/api /var/www/api

# Copia los archivos de configuración de Apache
COPY ./conf/vercontacto.conf /etc/apache2/sites-available/vercontacto.conf
RUN a2ensite vercontacto.conf && a2dissite 000-default.conf


# Expone los puertos necesarios
EXPOSE 80 8080

# Inicia Apache en primer plano
CMD ["apache2-foreground"]