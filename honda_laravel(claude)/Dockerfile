# PHP 8.2 com Apache
FROM php:8.2-apache

# Extensões necessárias para MySQL e Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli mbstring zip bcmath \
    && rm -rf /var/lib/apt/lists/*

# Habilita mod_rewrite para URLs amigáveis do Laravel
RUN a2enmod rewrite

# Configura o DocumentRoot para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permite .htaccess (AllowOverride All)
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia o projeto
COPY . .

# Instala dependências PHP (sem scripts de post-install que precisam do .env pronto)
RUN composer install --no-interaction --no-dev --optimize-autoloader --no-scripts 2>/dev/null || \
    composer install --no-interaction --no-scripts

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Script de entrypoint para rodar key:generate e cache na primeira vez
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
