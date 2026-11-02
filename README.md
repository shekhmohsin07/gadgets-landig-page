# Takbir Gadgets — Laravel 12 store

Home page + product landing pages (no cart) · order tracking · admin dashboard with Pixel setup.
Laravel 12 · MySQL · Blade · Bootstrap 5 · plain CSS/JS (no Node/Vite build needed).

## Install

Requirements: PHP 8.2+, MySQL 8 / MariaDB 10.6+ (pdo_mysql, mbstring, xml, fileinfo, gd). `vendor/` is already included, so Composer is only needed if you want to update packages.

```bash
cp .env.example .env          # skip if you already have your own .env
php artisan key:generate      # skip if your .env already has APP_KEY
# put your database + mail settings in .env
php artisan migrate --seed
php artisan serve
```

* Website: http://localhost:8000
* Admin: http://localhost:8000/admin/login (`ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env`)

### Updating an existing site with this version

1. Copy these files over your project (do **not** overwrite `.env` or `public/uploads/`).
2. Run `php artisan migrate`. The new migration `apply_takbir_theme_defaults` only switches the old blue/green colors and the old "Gadget Care" name/texts to the Takbir Gadgets defaults. Anything you edited yourself in Admin → General is left alone.
3. Run `php artisan view:clear && php artisan config:clear`, then hard-refresh the browser.

## What changed in this version

* **Theme:** red / black / white, matching the logo (header, buttons, footer, admin sidebar). Colors can still be changed in Admin → General (Brand color = red, Dark color = black).
* **Menu:** order-tracking icon (truck) in the top bar, in the side menu and in the mobile bottom bar. On desktop the header shows inline links.
* **Banner:** 95% of the screen width, centered, shown at its natural height (no cropping).
* **Product cards:** bigger price, old price under it, "Save ৳..." on the right.
* **Footer:** 3 columns (logo + name + description · links · contact + social icons). Copyright bar: 2 columns (© text · "Developed by Shekh Mohsin").
* Order tracking page, thank-you page and e-mail use the same theme. The thank-you page links to tracking.
* Home page: small trust strip (cash on delivery, delivery, tracking, support).

## Pixel setup

Admin → **Pixel setup**: Meta (Facebook) Pixel, TikTok Pixel, GA4, GTM and custom code. Events: PageView, ViewContent (landing page), InitiateCheckout (form start), Purchase (thank-you page, BDT).

## Where things are

* `routes/web.php` — routes
* `app/Http/Controllers` (+ `Admin/`), `app/Models`, `app/Mail`
* `resources/views` — storefront (`home`, `product`, `thanks`, `track-order`, `partials/`) and `admin/`
* `public/css/style.css` — storefront design · `public/js/store.js` — order form + pixel events
* `public/images/logo.jpg` — default logo (you can upload another in Admin → General)
