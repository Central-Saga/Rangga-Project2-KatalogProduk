#!/bin/sh
set -e

# Railway memberi variabel PORT; Apache default mendengarkan port 80.
if [ -n "$PORT" ]; then
    sed -ri "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
    sed -ri "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

if [ -z "$APP_KEY" ]; then
    echo "WARNING: APP_KEY belum di-set. Set di dashboard Railway (php artisan key:generate --show)." >&2
fi

# SQLite opsional: buat file bila dipakai dan belum ada.
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    mkdir -p database
    [ -f database/database.sqlite ] || touch database/database.sqlite
fi

php artisan config:clear >/dev/null 2>&1 || true
php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true

exec "$@"
