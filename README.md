# wurl-laravel

A Laravel 12 rebuild of the [wurl.io](https://wurl.io) website. The original site was written in raw PHP without a framework; this repository is a clean, framework-driven port of that codebase onto Laravel so the site can be maintained, tested, and extended using the modern Laravel ecosystem.

## Stack

- PHP 8.2+
- Laravel 12
- MySQL 5.7+ / 8.0+ (default; SQLite also supported)
- Node.js 18+ and npm (Vite + Tailwind CSS v4)
- Composer 2

## Requirements

Before cloning, make sure you have the following installed locally:

- [PHP 8.2 or newer](https://www.php.net/downloads) with the `mbstring`, `pdo_mysql`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo` and `curl` extensions enabled
- [Composer](https://getcomposer.org/download/)
- [Node.js & npm](https://nodejs.org/en/download)
- A running MySQL server (or use the bundled SQLite option — see below)

## Quick start — clone & run

```bash
# 1. Clone the repo
git clone <repository-url> wurl-laravel
cd wurl-laravel

# 2. Install PHP and JS dependencies
composer install
npm install

# 3. Create your environment file and generate an app key
cp .env.example .env        # Windows (PowerShell): Copy-Item .env.example .env
php artisan key:generate

# 4. Configure the database in .env, then run migrations
php artisan migrate

# 5. Build front-end assets
npm run build

# 6. Start the dev server
php artisan serve
```

The application will be available at <http://localhost:8000>.

### One-shot setup script

A `setup` composer script is included that runs steps 2–5 in one go:

```bash
composer run setup
```

## Development workflow

For day-to-day development, run the dev server together with the queue listener and Vite (HMR) using the bundled `dev` script:

```bash
composer run dev
```

This starts three processes concurrently:

- `php artisan serve` — the Laravel dev server
- `php artisan queue:listen --tries=1` — the queue worker
- `npm run dev` — Vite with hot module replacement

## Database

The project defaults to MySQL. Edit the `DB_*` values in `.env` to point to your local database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wurl_laravel
DB_USERNAME=root
DB_PASSWORD=
```

Create the database, then run:

```bash
php artisan migrate
```

To use SQLite instead, set `DB_CONNECTION=sqlite` in `.env`, create the database file, and migrate:

```bash
# macOS / Linux
touch database/database.sqlite
# Windows (PowerShell)
New-Item -ItemType File database/database.sqlite

php artisan migrate
```

## Testing

```bash
php artisan test
```

## Building for production

```bash
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
```

## Project structure

Standard Laravel 12 layout:

- `app/` — application code (controllers, models, services)
- `routes/` — HTTP, console, and channel route definitions
- `resources/` — Blade views, JS, CSS
- `database/` — migrations, factories, seeders
- `config/` — framework and application configuration
- `public/` — web server document root
- `bootstrap/app.php` — middleware, exceptions, and routing registration (Laravel 11/12 style)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). Project-specific content (wurl.io site assets and copy) belongs to its respective owner.
