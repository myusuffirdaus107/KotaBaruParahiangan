#!/usr/bin/env bash

# PROPERTI KOTABARU - QUICK START SCRIPT
# Run this file to setup the project quickly: chmod +x setup.sh && ./setup.sh

echo "🚀 Starting Properti Kotabaru Setup..."
echo "======================================"

# Step 1: Copy .env
echo "📄 Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ .env created"
else
    echo "✓ .env already exists"
fi

# Step 2: Generate keys
echo "🔑 Generating application key..."
php artisan key:generate

# Step 3: Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install

# Step 4: Install NPM dependencies
echo "📦 Installing NPM dependencies..."
npm install

# Step 5: Run migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Step 6: Seed database
echo "🌱 Seeding database with sample data..."
php artisan db:seed

# Step 7: Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Step 8: Build assets
echo "🎨 Building frontend assets..."
npm run build

# Step 9: Install Breeze
echo "🔐 Installing Laravel Breeze..."
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run build

# Step 10: Clear cache
echo "🧹 Clearing cache..."
php artisan cache:clear
php artisan view:clear
php artisan config:cache

echo ""
echo "✅ Setup Complete!"
echo "======================================"
echo ""
echo "📍 Next steps:"
echo "1. Edit .env file with your database credentials"
echo "2. Start dev server: php artisan serve"
echo "3. Start asset compiler: npm run dev (in another terminal)"
echo "4. Visit: http://localhost:8000"
echo ""
echo "👤 Login Credentials:"
echo "   Email: admin@kotabaru.com"
echo "   Password: password"
echo ""
echo "📚 Documentation:"
echo "   - SETUP_GUIDE.md"
echo "   - BREEZE_AUTH.md"
echo "   - PROJECT_CHECKLIST.md"
echo "   - README_PROJECT.md"
echo ""
echo "Happy coding! 🎉"
