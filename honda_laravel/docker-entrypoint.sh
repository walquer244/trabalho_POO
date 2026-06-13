#!/bin/bash
set -e

echo "🚀 Honda Dealership – Iniciando container..."

# ----- Aguarda MySQL estar disponível -----
echo "⏳ Aguardando banco de dados MySQL (host: ${DB_HOST:-db})..."
until php -r "
    try {
        \$pdo = new PDO(
            'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );
        echo 'OK';
    } catch (Exception \$e) {
        exit(1);
    }
" 2>/dev/null | grep -q OK; do
  echo "   MySQL ainda não está pronto. Aguardando 3 segundos..."
  sleep 3
done

echo "✅ MySQL pronto!"

# ----- Gera APP_KEY se ainda não existe -----
if php artisan key:status 2>&1 | grep -q "not set"; then
    echo "🔑 Gerando APP_KEY..."
    php artisan key:generate --force
fi

# ----- Roda migrations -----
echo "🗄️  Rodando migrations..."
php artisan migrate --force

# ----- Roda seeders -----
echo "🌱 Rodando seeders..."
php artisan db:seed --force

# ----- Limpa e otimiza caches -----
echo "⚡ Otimizando configurações..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ----- Garante permissões corretas -----
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "🎉 Aplicação Honda pronta! Acesse: http://localhost:8080"

# ----- Inicia o Apache em foreground -----
exec apache2-foreground
