# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 5.8 + Vue.js 2.7 e-commerce application with admin panel. PHP 7.2, Bootstrap 3.4.1, MySQL. Runs in Docker (PHP-FPM + Nginx + MySQL + phpMyAdmin).

## Commands

### Docker Services

```bash
docker-compose up -d                # Start all services
docker-compose down                 # Stop all services
```

Access: Web app at `localhost:8084`, phpMyAdmin at `localhost:8085`.

### Backend (Laravel)

All artisan/composer commands run inside the PHP container:

```bash
docker-compose run --rm --no-deps php composer install
docker-compose run --rm php php artisan migrate
docker-compose run --rm php php artisan db:seed
docker-compose run --rm php php artisan key:generate
```

### Frontend (Laravel Mix / Webpack 5)

Run from the `php/` directory:

```bash
npm install
npm run dev          # Development build
npm run watch        # Watch mode
npm run production   # Production build
```

### Testing

PHPUnit 7.5, tests use SQLite in-memory database (configured in `phpunit.xml`):

```bash
# Full suite
docker-compose run --rm php vendor/bin/phpunit

# Single suite
docker-compose run --rm php vendor/bin/phpunit --testsuite Unit
docker-compose run --rm php vendor/bin/phpunit --testsuite Feature

# Single test file
docker-compose run --rm php vendor/bin/phpunit tests/Unit/ExampleTest.php
```

## Architecture

### Directory Layout

The Laravel app lives entirely inside `php/`. Docker config is at the repo root (`docker-compose.yml`, `dockerfile/`, `web/`, `db/`).

### Backend Layers (php/app/)

- **Controllers/** -- Web controllers; `Admin/` sub-namespace for admin panel (RBAC-protected)
- **Models/** -- Eloquent models (Product, User, Order, etc.)
- **Repositories/** -- Data access abstraction layer
- **Services/** -- Business logic (transactions, validation flows, external API calls)
- **Presenters/** -- Presentation/formatting layer
- **Policies/** -- Authorization policies

### Frontend (php/resources/)

- **js/app.js** -- Vue.js entry point, mounted on `#app`
- **js/components/** -- Vue components
- **sass/app.scss** -- Main SCSS entry point
- **views/** -- Blade templates organized by section (`admin/`, `auth/`, `member/`, `layouts/`)

### Routes

Defined in `php/routes/web.php`. Key route groups: `/` (home), `/category`, `/product`, `/cart`, `/member` (authenticated), `/admin` (authenticated + RBAC).

### Asset Pipeline

`webpack.mix.js` compiles JS + SASS and copies Bootstrap CSS and custom stylesheets to `public/`.

### Key Packages

- `jeroennoten/laravel-adminlte` -- Admin dashboard template
- `yajra/laravel-datatables-oracle` -- Server-side DataTables
- `unisharp/laravel-filemanager` -- File upload/management
- `ckeditor/ckeditor` -- WYSIWYG editor
