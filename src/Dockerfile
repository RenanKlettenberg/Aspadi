FROM php:8.2-apache

# 1. Instala dependências do sistema para o Postgres e Composer
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# 2. Habilita o mod_rewrite do Apache para rotas amigáveis
RUN a2enmod rewrite

# Instala o Xdebug via PECL
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Configurações do Xdebug para o Docker
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
    
# 3. Permite que o .htaccess sobrescreva configurações (necessário para Engines)
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# 4. Instala o Composer formalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Ajuste de permissões para que o Apache consiga ler os arquivos
RUN chown -R www-data:www-data /var/www/html