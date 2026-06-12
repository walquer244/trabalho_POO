#!/bin/bash
set -e

# Copia .env se não existir
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.example /var/www/html/.env 2>/dev/null || true
fi

# Gera APP_KEY se ainda for o placeholder
if grep -q "CHANGE_ME" /var/www/html/.env 2>/dev/null; then
    php artisan key:generate --force
fi

# Cria diretórios de cache/sessão se não existirem
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Executa o comando passado (apache2-foreground)
exec "$@"
