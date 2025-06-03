@echo off
echo =================================
echo CS Learning Platform Setup
echo =================================
echo.

echo [1/6] Installing Composer dependencies...
composer install --no-dev --optimize-autoloader
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo [2/6] Copying environment file...
if not exist .env (
    copy .env.example .env
    echo Environment file created. Please update database settings if needed.
) else (
    echo Environment file already exists.
)

echo [3/6] Generating application key...
php artisan key:generate --force

echo [4/6] Creating database file...
if not exist database\database.sqlite (
    echo. > database\database.sqlite
    echo SQLite database file created.
) else (
    echo Database file already exists.
)

echo [5/6] Running database migrations...
php artisan migrate --force

echo [6/6] Seeding database with sample data...
php artisan db:seed --force

echo.
echo =================================
echo Setup Complete!
echo =================================
echo.
echo To start the development server, run:
echo php artisan serve
echo.
pause
