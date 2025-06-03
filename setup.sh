#!/bin/bash

echo "================================="
echo "CS Learning Platform Setup"
echo "================================="
echo

echo "[1/6] Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed!"
    exit 1
fi

echo "[2/6] Copying environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Environment file created. Please update database settings if needed."
else
    echo "Environment file already exists."
fi

echo "[3/6] Generating application key..."
php artisan key:generate --force

echo "[4/6] Creating database file..."
if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
    echo "SQLite database file created."
else
    echo "Database file already exists."
fi

echo "[5/6] Running database migrations..."
php artisan migrate --force

echo "[6/6] Seeding database with sample data..."
php artisan db:seed --force

echo
echo "================================="
echo "Setup Complete!"
echo "================================="
echo
echo "To start the development server, run:"
echo "php artisan serve"
echo
