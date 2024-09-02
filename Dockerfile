# Imagem oficial do PHP
FROM php:8.2.18-fpm

# Instale as dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \ 
    && docker-php-ext-install pdo_pgsql

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurando o diretório de trabalho
WORKDIR /var/www/html

# Copiando os arquivos da aplicação
COPY . .

# Configurando as permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Iniciando o servidor PHP-FPM
CMD ["php-fpm"]