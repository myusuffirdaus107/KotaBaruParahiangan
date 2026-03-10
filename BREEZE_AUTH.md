# Laravel Breeze Authentication Setup

## Instalasi

Laragon Breeze sudah included dalam project ini. Jika belum, jalankan:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run build
```

## File-File yang Di-Generate

Breeze akan membuat:

```
app/Http/Controllers/Auth/
├── AuthenticatedSessionController.php
├── ConfirmablePasswordController.php
├── EmailVerificationNotificationController.php
├── EmailVerificationPromptController.php
├── NewPasswordController.php
├── PasswordController.php
├── PasswordResetLinkController.php
├── RegisteredUserController.php
└── VerifyEmailController.php

resources/views/auth/
├── confirm-password.blade.php
├── forgot-password.blade.php
├── login.blade.php
├── register.blade.php
├── reset-password.blade.php
└── verify-email.blade.php

resources/views/layouts/
├── app.blade.php
├── guest.blade.php
└── navigation.blade.php

routes/auth.php (Auto-generated routes)
```

## Routes

```php
// Dari routes/auth.php (auto-loaded di routes/web.php)

// Login
GET/POST    /login
POST        /logout

// Register
GET/POST    /register

// Password Reset
GET/POST    /forgot-password
GET/POST    /reset-password/{token}

// Email Verification
GET         /verify-email
POST        /verify-email/notification
GET         /confirm-password
```

## Integration dengan Project

### 1. Navigation Component
File: `resources/views/layouts/navigation.blade.php` sudah ter-generate.
Edit jika perlu menambah menu khusus untuk admin.

### 2. Auth Guard
Default menggunakan 'web' guard. Tidak perlu diubah.

### 3. Logout Route
```blade
<!-- di layout/navigation -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
```

## Customization

### 1. Ubah Design/Style
Breeze views berada di `resources/views/auth/`
Edit sesuai kebutuhan (Bootstrap/Tailwind).

### 2. Add Role Check di Login
```php
// Di AuthenticatedSessionController.php
public function store(LoginRequest $request)
{
    $request->authenticate();
    $request->session()->regenerate();
    
    // Redirect berdasarkan role
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->intended(route('admin.dashboard'));
    }
    
    return redirect()->intended(route('home'));
}
```

### 3. Custom Email Verification (Optional)
Edit `app/Http/Requests/LoginRequest.php` dan auth controllers.

## Commands

```bash
# Generate Breeze
php artisan breeze:install

# Publish views (untuk customize)
php artisan vendor:publish --tag=breeze-views

# Clear cache setelah update
php artisan cache:clear
```

## Login Credentials

Setelah `php artisan migrate --seed`:

```
Admin User:
- Email: admin@kotabaru.com
- Password: password

Sample User:
- Email: user@example.com  
- Password: password
```

## Security Notes

- Password di-hash otomatis
- CSRF protection enabled
- Rate limiting active
- Session management included
- Remember me functionality available

## Troubleshooting

### Login tidak bekerja
```bash
php artisan migrate
php artisan db:seed
php artisan cache:clear
```

### Styling tidak muncul
```bash
npm run build
php artisan serve
```

### Session error
Edit `.env`:
```
SESSION_DRIVER=file  (local dev)
SESSION_DRIVER=cookie (production)
```
