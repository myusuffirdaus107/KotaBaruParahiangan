# Admin Panel Setup Guide

## Status: ✅ COMPLETE

The admin panel has been successfully created and configured. The database has been initialized with migrations and seeding.

---

## Admin Credentials

**Email:** admin@kotabaru.com  
**Password:** password

---

## Accessing the Admin Panel

1. Start your Laravel development server:
   ```
   php artisan serve
   ```

2. Navigate to: `http://localhost:8000/admin/login`

3. Log in with the credentials above

---

## Admin Features

### Dashboard (`/admin/dashboard`)
- **Statistics:** View total properties, inquiries, sliders, launching campaigns, and categories
- **Quick Actions:** Direct buttons to create new items
- **Recent Inquiries:** View 5 most recent contact form submissions
- **Featured Properties:** View 5 featured properties

### Properties Management (`/admin/properties`)
**Full CRUD Operations:**
- ✅ **Create:** Add new properties with:
  - Title, Slug (unique)
  - Category selection
  - Location
  - Pricing (from/to)
  - Short & long descriptions
  - Featured & Available flags
  - Brochure PDF upload
  
- ✅ **Read:** View all properties in paginated list (15 per page)
  - Displays: Title, Category, Location, Featured status, Available status
  
- ✅ **Update:** Edit property details
  - All fields are editable
  - Slug validation: must be unique (except current property)
  
- ✅ **Delete:** Remove properties with confirmation

### Categories Management (`/admin/categories`)
**Full CRUD Operations:**
- Create property categories
- Fields: Name (unique), Slug (unique), Font Awesome Icon class, Description
- Used in property categorization (hunian, business, etc.)

### Sliders Management (`/admin/sliders`)
**Full CRUD Operations:**
- Manage homepage carousel sliders
- Fields: Title, Subtitle, Description, Image URL, Button Text & Link, Active toggle

### Launching Campaigns (`/admin/launchings`)
**Full CRUD Operations:**
- Manage property launch announcements
- Fields: Name, Slug (unique in launchings), Location, Developer Name, Launch Date, Description, Image URL, Active toggle

### Inquiries Management (`/admin/inquiries`)
**Read-Only / Status Update:**
- ✅ **View All:** Paginated list of contact form submissions (15 per page)
  - Shows: Date, Name, Email, Phone, Message preview, Contact Status
  - Status badges: "Terhubung" (Contacted) / "Belum" (Not Contacted)
  
- ✅ **View Detail:** Click to see full inquiry:
  - Complete information (Name, Email, Phone, Date)
  - Full message text
  - Related property (if mentioned)
  - Status and timestamp
  
- ✅ **Mark as Contacted:** Toggle contacted status without leaving the page
  
- ✅ **Delete:** Remove inquiries permanently

---

## Technical Architecture

### File Structure
```
app/Http/Controllers/Admin/
  ├── AuthController.php          (Login/Logout)
  ├── DashboardController.php     (Statistics & Overview)
  ├── PropertyController.php      (Properties CRUD)
  ├── CategoryController.php      (Categories CRUD)
  ├── SliderController.php        (Sliders CRUD)
  ├── LaunchingController.php     (Launching CRUD)
  └── InquiryController.php       (Inquiries - Read/Status)

app/Http/Middleware/
  └── IsAdmin.php                 (Admin role verification)

resources/views/admin/
  ├── layouts/
  │   └── app.blade.php           (Master layout with sidebar)
  ├── auth/
  │   └── login.blade.php         (Login page)
  ├── dashboard.blade.php         (Dashboard)
  ├── properties/
  │   ├── index.blade.php         (Properties list)
  │   └── form.blade.php          (Create/Edit form)
  ├── categories/
  │   ├── index.blade.php
  │   └── form.blade.php
  ├── sliders/
  │   ├── index.blade.php
  │   └── form.blade.php
  ├── launchings/
  │   ├── index.blade.php
  │   └── form.blade.php
  └── inquiries/
      ├── index.blade.php         (List)
      └── show.blade.php          (Detail view)

routes/web.php                    (Admin routes with middleware)
bootstrap/app.php                 (Admin middleware alias)
```

### Database Tables
- ✅ `users` - User authentication with role column ('admin' / 'user')
- ✅ `categories` - Property categories
- ✅ `properties` - Property listings
- ✅ `property_images` - Property images
- ✅ `sliders` - Homepage carousel
- ✅ `launchings` - Launch campaigns
- ✅ `inquiries` - Contact form submissions

### Authentication & Security
- Role-based access control: Only users with `role = 'admin'` can access admin panel
- Middleware protection: `IsAdmin` middleware on all admin routes
- Session management: Proper password hashing and session regeneration
- CSRF protection: All forms include CSRF tokens

---

## Color Scheme

**Primary Colors:**
- Blue gradient: `#1e3a8a` to `#3b82f6`
- Gold accent: `#f59e0b`
- White background: Admin interface

**Status Indicators:**
- Green: "Contacted" status
- Yellow: "Not Contacted" status
- Blue: Primary actions
- Red: Delete/Destructive actions

---

## Validation Rules

### Properties
- Title: Required, max 255 chars
- Slug: Required, unique, max 255 chars
- Category: Required, must exist in categories
- Location: Required, max 255 chars
- Price fields: Numeric (optional)
- Description: Text (optional)
- Brochure: PDF only, max 10MB

### Categories
- Name: Required, unique, max 255 chars
- Slug: Required, unique, max 255 chars
- Icon: Required (Font Awesome class)
- Description: Text (optional)

### Sliders
- Title: Required, max 255 chars
- Image URL: Required
- Button text: Text (optional)
- Button link: URL (optional)

### Launching
- Name: Required, max 255 chars
- Slug: Required, unique, max 255 chars
- Location: Required

---

## Troubleshooting

### Session Issues
If you get "Session Driver Not Configured" error:
```bash
php artisan config:clear
php artisan cache:clear
```

### Database Issues
If migrations fail:
```bash
php artisan migrate:refresh --seed
```

### Permission Issues
Ensure `/storage` and `/bootstrap/cache` directories are writable:
```bash
chmod -R 775 storage bootstrap/cache
```

---

## Next Steps

1. ✅ Log in to the admin panel
2. Customize categories for your properties
3. Create property listings
4. Set up carousel sliders
5. Configure launching campaigns
6. Monitor contact form inquiries
7. Update admin profile (optional)

---

**Admin Panel Created:** March 4, 2026  
**Database Seeded:** Yes  
**Status:** Ready for use  
