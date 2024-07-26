# Use a imagem oficial do PHP como base
FROM php:8.2.18-fpm

# Instale dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql

# Instale Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos da aplicação
COPY . .

# Instale as dependências do Laravel
RUN composer install

# Gere a chave da aplicação Laravel
RUN php artisan key:generate

# Configure permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 9000 e inicie o servidor PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]