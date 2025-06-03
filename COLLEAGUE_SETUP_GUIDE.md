# Quick Setup Guide for Colleagues 🚀

This repository has been prepared for **instant setup** - no migrations, seeders, or dependency installation needed!

## Prerequisites

Before cloning this project, you'll need to install the following on your system:

### 1. PHP 8.1 or higher with required extensions

#### For Windows:
```powershell
# Install PHP using Chocolatey (recommended)
choco install php

# Or download from: https://windows.php.net/download/

# Verify installation
php --version
```

#### For macOS:
```bash
# Install PHP using Homebrew
brew install php

# Verify installation
php --version
```

#### For Linux (Ubuntu/Debian):
```bash
# Install PHP and required extensions
sudo apt update
sudo apt install php8.1 php8.1-cli php8.1-common php8.1-curl php8.1-mbstring php8.1-xml php8.1-zip php8.1-sqlite3

# Verify installation
php --version
```

### 2. Composer (PHP Package Manager)

#### For Windows:
```powershell
# Install using Chocolatey
choco install composer

# Or download from: https://getcomposer.org/download/
```

#### For macOS:
```bash
# Install using Homebrew
brew install composer
```

#### For Linux:
```bash
# Install Composer globally
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Node.js and npm (for frontend assets)

#### For Windows:
```powershell
# Install using Chocolatey
choco install nodejs

# Or download from: https://nodejs.org/
```

#### For macOS:
```bash
# Install using Homebrew
brew install node
```

#### For Linux:
```bash
# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs
```

## Quick Start (Ready to Run!)

1. **Clone the repository:**
   ```bash
   git clone https://github.com/StenlyLukmana/Software_Engineering_AOL.git
   cd Software_Engineering_AOL
   ```

2. **Create and configure environment file:**
   ```bash
   # Option 1: Use the SQLite-ready template (recommended)
   cp .env.sqlite .env
   
   # Option 2: Use the standard template and modify it
   cp .env.example .env
   
   # On Windows:
   copy .env.sqlite .env
   # or
   copy .env.example .env
   ```

3. **Configure database settings (if using .env.example):**
   If you copied from `.env.example`, edit the `.env` file and change the database configuration from MySQL to SQLite:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   # Comment out or remove these MySQL settings:
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

4. **Install frontend dependencies and build assets:**
   ```bash
   npm install
   npm run build
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```

7. **Open your browser and visit:** `http://localhost:8000`

## ✅ That's it! The application is ready to use!

### What's Already Set Up:

- ✅ **All Composer dependencies** (vendor folder included)
- ✅ **SQLite database** with seeded data
- ✅ **Course data** pre-loaded
- ✅ **User accounts** ready for testing
- ✅ **Quiz functionality** fully configured
- ✅ **Authentication system** ready

### Test Accounts Available:

The database comes with pre-seeded test accounts. Check the database seeders or create new accounts through the registration system.

## Development Notes

- The project uses **SQLite** as the database (no additional database server needed)
- All dependencies are included in this repository for immediate setup
- The `.env` file will need to be configured for your local environment
- Frontend assets will need to be built with `npm run build` or `npm run dev`

## Troubleshooting

### Database Configuration Error (Windows Path Issue):
If you get an error like "Failed to parse dotenv file. Encountered an unexpected escape sequence":

1. **Use relative path** (recommended):
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

2. **Or if using absolute path, use forward slashes**:
   ```env
   # ❌ Wrong (backslashes cause parsing errors):
   # DB_DATABASE="C:\Users\Name\path\to\database.sqlite"
   
   # ✅ Correct (forward slashes work on Windows):
   DB_DATABASE="C:/Users/Name/path/to/database.sqlite"
   ```

3. **Clear cache after fixing**:
   ```bash
   php artisan config:clear
   ```

### Database Connection Error (MySQL instead of SQLite):
If you get an error like "No connection could be made because the target machine actively refused it":

1. **Check your `.env` file** - Make sure it's configured for SQLite:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

2. **NOT MySQL** (comment these out):
   ```env
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_USERNAME=root
   # DB_PASSWORD=
   ```

3. **Clear Laravel cache** after changing `.env`:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

### If you encounter permission issues:
```bash
# Make sure storage and cache directories are writable
chmod -R 775 storage bootstrap/cache
```

### If you need to reset the database:
```bash
# The database is already set up, but if needed:
php artisan migrate:fresh --seed
```

### For frontend development:
```bash
# Run in development mode with hot reload
npm run dev
```

## Need Help?

If you encounter any issues:
1. Make sure all prerequisites are installed
2. Check that PHP extensions are enabled (especially sqlite3, mbstring, xml)
3. Verify that the `.env` file is properly configured
4. Contact the team if problems persist

---

**Note:** This repository temporarily includes vendor dependencies and database files for easy setup. For ongoing development, these will be gitignored as normal.
