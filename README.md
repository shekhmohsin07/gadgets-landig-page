# Gadgets Items — Laravel store (home page + product landing pages)

Laravel · MySQL · Blade · Bootstrap 5 · plain CSS/JS (no Node/Vite build needed)

## What you get

* **Home page** – banner slider, *Top Selling Products*, *Popular Products*, customer reviews. No cart: every **Buy Now** button opens that product's landing page.
* **Landing pages** – one per product at `/product/<slug>` (4 ready-made: Scalp Massager, Blackhead Remover, Massage Gun, Grinder Blender; the other 5 home products also have pages). Image slider, price/discount, Order Now / WhatsApp / Call buttons, description, customer-review screenshots, order form (Cash on Delivery, delivery area, quantity, live total), related products.
* **Order flow** – saves the order, shows a thank-you page.
* **Admin dashboard** (`/admin`) – orders (status, notes, search), products/landing pages (images, gallery, review screenshots, badges, sections), home banners, customer reviews, general settings (logo, brand colors, phone, WhatsApp, delivery charge) and **Pixel setup**.
* **Pixel setup** (Admin → Pixel setup) – Meta (Facebook) Pixel, TikTok Pixel, Google Analytics 4, Google Tag Manager, plus custom head/body code. Sends PageView, ViewContent, InitiateCheckout and Purchase (in BDT) automatically.

## Install (local)

Requirements: PHP 8.3+, Composer, MySQL 8 / MariaDB 10.6+ (extensions: pdo_mysql, mbstring, xml, fileinfo, gd).

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Create an empty MySQL database (for example `gadgetcare`), then edit `.env`:

```
DB_DATABASE=gadgets_item
DB_USERNAME=root
DB_PASSWORD=your_password
ADMIN_EMAIL=you@example.com
ADMIN_PASSWORD=a-strong-password
APP_URL=http://localhost:8000
```

```bash
php artisan migrate --seed
php artisan serve
```

* Website: http://localhost:8000
* Admin:   http://localhost:8000/admin/login (use the `ADMIN_EMAIL` / `ADMIN_PASSWORD` from `.env`; change it under *Change password*).

The seeder adds the 9 products from your current site with **placeholder images** (`public/images/products/*.svg`) and one banner. Replace them from *Admin → Products* and *Admin → Home banners*. Sample descriptions are placeholders too — edit them.

## Add another landing page

Admin → Products → **New product**. Fill name, price, old price, description, images; tick *Top Selling* and/or *Popular* to show it on the home page. Its landing page (`/product/<slug>`) is live immediately.

## Pixel setup

Admin → **Pixel setup**: paste the Pixel ID(s) and save. Check with the Meta Pixel Helper / TikTok Pixel Helper browser extensions. Events:

| When | Meta | TikTok | GA4 | GTM dataLayer |
|---|---|---|---|---|
| Any page | PageView | page() | page_view | – |
| Landing page opens | ViewContent | ViewContent | view_item | gc_viewcontent |
| Starts the order form | InitiateCheckout | InitiateCheckout | begin_checkout | gc_initiatecheckout |
| Order placed | Purchase | CompletePayment | purchase | gc_purchase |

These are browser-side pixels. Server-side Conversions API is not included.

## Deploy (cPanel / VPS)

1. Upload the project, run `composer install --no-dev --optimize-autoloader`.
2. Point the domain's document root to the `public/` folder.
3. Set `.env`: `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain`, DB details.
4. `php artisan migrate --seed`, then `php artisan config:cache route:cache view:cache`.
5. Make `storage/`, `bootstrap/cache/` and `public/uploads/` writable (755/775).

Uploaded images are saved in `public/uploads` (no `storage:link` needed). Back this folder up together with the database.

## Where things are

* `routes/web.php` – all routes
* `app/Http/Controllers` (+ `Admin/`) – controllers · `app/Models` – Product, Order, Banner, Testimonial, Setting
* `resources/views` – storefront (`home`, `product`, `thanks`, `partials/`) and `admin/`
* `public/css/style.css` – storefront design (brand colors are CSS variables set from Admin → General)
* `public/js/store.js` – order form logic + pixel event helper
* `database/migrations`, `database/seeders`
