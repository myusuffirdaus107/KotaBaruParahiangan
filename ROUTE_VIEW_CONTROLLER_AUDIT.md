# Route/View/Controller Mismatch Audit Report
**Generated:** March 9, 2026  
**Project:** Kotabaru Admin Panel

---

## Executive Summary

Found **1 CRITICAL ISSUE** that will cause 404 errors in production:
- **FacilityController** uses wrong route names (singular instead of plural)
- All routes are defined correctly (plural: `admin.facilities.*`)
- All blade files reference routes correctly (plural: `admin.facilities.*`)
- Only the controller is doing the wrong redirects

Found **1 MEDIUM ISSUE** (naming inconsistency):
- Facility folder uses singular naming while all other resources use plural

---

## 🔴 CRITICAL: Route Name Mismatch in FacilityController

### The Problem

**Routes defined (web.php):**
```php
Route::resource('facilities', AdminFacilityController::class);  // plural!
Route::get('facilities/{facility}/items', [...]);               // plural!
```

**Controller redirects to (FacilityController.php):**
```php
redirect()->route('admin.facility.index')      // singular! 🔴 WRONG
redirect()->route('admin.facility.items')      // singular! 🔴 WRONG
```

**When users click "Save", they get:**
- ❌ 404 Not Found error
- Route `admin.facility.index` does not exist
- Route `admin.facilities.index` is what Laravel expects

### Affected Lines in FacilityController

| Line | Method | Current Code | Should Be |
|------|--------|--------------|-----------|
| 56 | store() | `redirect()->route('admin.facility.index')` | `redirect()->route('admin.facilities.index')` |
| 94 | update() | `redirect()->route('admin.facility.index')` | `redirect()->route('admin.facilities.index')` |
| 106 | destroy() | `redirect()->route('admin.facility.index')` | `redirect()->route('admin.facilities.index')` |
| 138 | storeItem() | `redirect()->route('admin.facility.items', $facility)` | `redirect()->route('admin.facilities.items', $facility)` |
| 162 | updateItem() | `redirect()->route('admin.facility.items', $facility)` | `redirect()->route('admin.facilities.items', $facility)` |
| 174 | destroyItem() | `redirect()->route('admin.facility.items', $facility)` | `redirect()->route('admin.facilities.items', $facility)` |

### Impact Assessment

✅ **What Works Fine:**
- Blade files correctly use `route('admin.facilities.xxx')` 
- Navigation links work (in sidebar, layout)
- View paths work (`admin.facility.index` maps to correct files)

❌ **What Breaks:**
- Create resource (store) - redirects to non-existent route
- Update resource (update) - redirects to non-existent route  
- Delete resource (destroy) - redirects to non-existent route
- Create facility item (storeItem) - redirects to non-existent route
- Update facility item (updateItem) - redirects to non-existent route
- Delete facility item (destroyItem) - redirects to non-existent route

---

## 🟠 MEDIUM: Directory Structure Inconsistency

### The Problem

**Current naming:**
```
resources/views/admin/
├── auth/              ← singular
├── dashboard.blade.php
├── facility/          ← SINGULAR 🟠 inconsistent!
├── categories/        ← PLURAL ✓
├── properties/        ← PLURAL ✓
├── sliders/           ← PLURAL ✓
├── launchings/        ← PLURAL ✓
├── inquiries/         ← PLURAL ✓
├── users/             ← PLURAL ✓
└── layouts/
```

### Why It Matters

While it technically works now (due to the naming in blade files), it:
1. Violates consistency standards
2. Makes the codebase harder to read
3. May cause confusion for new developers
4. Doesn't match Laravel resource conventions

### Recommended Convention

All resource folders should be **plural**:
```
facility/ → facilities/     (rename directory)
```

---

## ✅ Verification Results

### Routes (web.php) - PERFECT

All routes correctly use plural form:
```php
Route::resource('properties', ... );      ✓
Route::resource('categories', ... );      ✓
Route::resource('sliders', ... );         ✓
Route::resource('launchings', ... );      ✓
Route::resource('facilities', ... );      ✓ (correct!)
Route::resource('inquiries', ... );       ✓ (read-only)
Route::resource('users', ... );           ✓
```

### Blade Files - ALL CORRECT

All blade files correctly reference plural route names:

**facility/index.blade.php**
- ✅ L8: `route('admin.facilities.create')`
- ✅ L66: `route('admin.facilities.edit', $facility)`
- ✅ L69: `route('admin.facilities.items', $facility)`
- ✅ L72: `route('admin.facilities.destroy', $facility)`

**facility/form.blade.php**
- ✅ L7: `route('admin.facilities.index')`
- ✅ L13: `route('admin.facilities.update', $facility)`
- ✅ L13: `route('admin.facilities.store')`
- ✅ L137: `route('admin.facilities.index')`

**layouts/app.blade.php**
- ✅ L387: `route('admin.facilities.index')`
- ✅ L387: `Route::is('admin.facilities.*')`

### Controllers - ONE ISSUE

| Controller | View Paths | Redirects | Status |
|------------|-----------|-----------|--------|
| PropertyController | `admin.properties.*` | `admin.properties.*` | ✅ |
| CategoryController | `admin.categories.*` | `admin.categories.*` | ✅ |
| SliderController | `admin.sliders.*` | `admin.sliders.*` | ✅ |
| LaunchingController | `admin.launchings.*` | `admin.launchings.*` | ✅ |
| InquiryController | `admin.inquiries.*` | `admin.inquiries.*` | ✅ |
| UserController | `admin.users.*` | `admin.users.*` | ✅ |
| **FacilityController** | `admin.facility.*` | **`admin.facility.*`** | ❌ WRONG |

---

## 📋 Complete Findings Summary

### What's Correct
- ✅ Route name definitions (web.php)
- ✅ All blade file route references
- ✅ 6 out of 7 controllers (PropertyController, CategoryController, SliderController, LaunchingController, InquiryController, UserController)
- ✅ View file structure organization

### What's Wrong
- ❌ FacilityController redirect route names (6 occurrences)
- ❌ FacilityController view path naming (inconsistent with routes)
- ❌ Facility folder naming (singular instead of plural)

---

## 🔧 Recommended Fixes

### Option A: Minimal Fix (Only Fix Route Names)

**10 seconds to apply**

In `app/Http/Controllers/Admin/FacilityController.php`, replace:
- All `admin.facility.` with `admin.facilities.` in redirect statements

**Files to change:** 1 file
**Lines to change:** 6 lines

### Option B: Complete Fix (Also Fix Folder Naming)

**5 minutes to apply**

1. Rename folder: `resources/views/admin/facility/` → `resources/views/admin/facilities/`
2. Update FacilityController view paths: `admin.facility.*` → `admin.facilities.*`
3. Update FacilityController redirect routes: `admin.facility.*` → `admin.facilities.*`

**Files to change:** 
- Rename 1 folder (4 blade files moved)
- Update 1 controller (10 total changes)
- No blade files need changes (already correct!)

**Impact:** Fully consistent naming convention across entire admin panel

---

## 🚀 Next Steps

1. **Immediate (Critical):** Apply Option A or B to fix 404 errors
2. **Test:** Create, edit, delete a facility to verify redirects work
3. **Test:** Verify facility items CRUD also works
4. **Deploy:** Update production after testing

---

## Code Comparison Examples

### Before (BROKEN)
```php
// FacilityController.php Line 56
public function store(Request $request)
{
    // ... validation ...
    Facility::create($validated);
    return redirect()->route('admin.facility.index')  // ❌ Route doesn't exist!
        ->with('success', 'Fasilitas berhasil ditambahkan');
}
```

### After (FIXED)
```php
// FacilityController.php Line 56
public function store(Request $request)
{
    // ... validation ...
    Facility::create($validated);
    return redirect()->route('admin.facilities.index')  // ✅ Route exists!
        ->with('success', 'Fasilitas berhasil ditambahkan');
}
```

---

## Audit Checklist

- ✅ Searched all blade files for route references
- ✅ Searched all controllers for route() and view() calls
- ✅ Verified all route definitions in web.php
- ✅ Checked directory structure consistency
- ✅ Cross-referenced all resource names
- ✅ Identified all mismatches with line numbers
- ✅ Categorized by severity (Critical/Medium)
- ✅ Provided detailed fix recommendations

---

## Related Files Reference

**Route Definitions:**
- `routes/web.php` - Lines 65-85 (Admin routes)

**Controllers:**
- `app/Http/Controllers/Admin/FacilityController.php` - Lines 56, 94, 106, 138, 162, 174

**Blade Templates:**
- `resources/views/admin/facility/index.blade.php`
- `resources/views/admin/facility/form.blade.php`
- `resources/views/admin/layouts/app.blade.php` - Line 387

---

**Report Status:** ✅ COMPLETE  
**Audit Severity:** 🔴 CRITICAL (1 issue) + 🟠 MEDIUM (1 issue)  
**Recommended Action:** Fix immediately before deploying to production
