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

2. **Create environment file:**
   ```bash
   # Copy the example environment file
   cp .env.example .env
   
   # Or on Windows:
   copy .env.example .env
   ```

3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

4. **Install frontend dependencies and build assets:**
   ```bash
   npm install
   npm run build
   ```

5. **Start the development server:**
   ```bash
   php artisan serve
   ```

6. **Open your browser and visit:** `http://localhost:8000`

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
