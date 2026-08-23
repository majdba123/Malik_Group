# Malik Group Furniture Catalog

[English](README.md) | [العربية](README_AR.md)

> A Laravel-powered furniture catalog and administration platform for presenting categorized products, rich product galleries, pricing, search and filtering, and direct customer contact.

## Overview

Malik Group is a furniture and interiors web platform built around two clear surfaces:

- a public **storefront/catalog** where visitors can discover categories and furniture products;
- an authenticated **administration dashboard** for managing products, categories, imagery, publication state, and site footer content.

The project is implemented as a server-rendered Laravel application with Blade templates and a Vite/Tailwind frontend asset pipeline. Product discovery and management are handled inside the same application, keeping the public catalog and operational administration connected through a single data model.

## Core Capabilities

### Public Storefront

The public side of the application includes:

- home-page product catalog;
- furniture categories;
- featured / recently added products;
- category-specific browsing;
- product search;
- minimum and maximum price filtering;
- paginated product listings;
- dedicated product detail pages;
- multi-image product galleries;
- full-screen product image viewing;
- displayed pricing and currency;
- direct WhatsApp contact using the product contact number;
- responsive storefront navigation and layouts.

Only products in the active state are exposed through the public catalog queries.

### Administration

The protected administration area includes dedicated management flows for:

- dashboard access;
- product management;
- product image management;
- category management;
- product publication status;
- product pricing and contact details;
- site footer settings;
- authenticated admin access.

Administrative routes are protected by the application's `admin` middleware.

## Product Model

The current catalog model is intentionally focused and practical. A product can include:

- category;
- name;
- description;
- contact phone number;
- price;
- publication status;
- multiple ordered images.

The application currently distinguishes active and pending product states, and the storefront only queries active products.

## Architecture

```text
┌───────────────────────────────┐
│       Public Storefront       │
│     Laravel Blade Views       │
│ Catalog • Search • Products   │
└───────────────┬───────────────┘
                │
                ▼
┌───────────────────────────────┐
│      Laravel Application      │
│ Controllers • Validation     │
│ Authentication • Middleware  │
└───────────────┬───────────────┘
                │
                ▼
┌───────────────────────────────┐
│     Eloquent / Database       │
│ Categories • Products •      │
│ Product Images • Settings    │
└───────────────▲───────────────┘
                │
┌───────────────┴───────────────┐
│      Admin Dashboard          │
│ Products • Categories •      │
│ Site Footer Management       │
└───────────────────────────────┘
```

## Technology Stack

| Area | Technology |
| --- | --- |
| Backend | PHP 8.3+, Laravel 13 |
| Rendering | Laravel Blade |
| ORM | Laravel Eloquent |
| Frontend tooling | Vite 8 |
| Styling | Tailwind CSS 4 |
| HTTP client / frontend utility | Axios |
| Testing | PHPUnit 12 |
| Build / local process tooling | npm, Composer, Concurrently |
| Production deployment | GitHub Actions + SSH |

## Repository Structure

```text
.
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # Protected management flows
│   │   ├── Auth/               # Authentication
│   │   └── Storefront/         # Public catalog controllers
│   └── Models/                 # Product, category, image, user, settings models
├── database/
│   ├── migrations/             # Application schema
│   └── seeders/                # Demo/catalog seed data
├── resources/
│   ├── css/                    # Frontend styles
│   ├── js/                     # Frontend scripts
│   └── views/
│       ├── admin/              # Admin interface
│       ├── auth/               # Login/auth views
│       ├── components/         # Shared Blade components
│       ├── layouts/            # Page layouts
│       └── storefront/         # Public catalog pages
├── routes/
│   └── web.php                 # Storefront, authentication and admin routes
├── public/                     # Public assets and Laravel entry point
├── tests/                      # Automated tests
├── .github/workflows/          # Production deployment workflow
├── composer.json
└── package.json
```

## Main Web Routes

The application exposes a focused browser-based flow:

```text
/                         Public storefront
/categories/{category}    Category catalog
/products/{product}       Product details
/login                    Administrator login
/dashboard                Administrator dashboard
/dashboard/categories     Category management
/dashboard/products       Product management
/dashboard/site-footer    Footer content settings
```

## Catalog Filtering

The storefront product query supports filtering by:

- category;
- product name search;
- minimum price;
- maximum price.

Filters are applied at the query level and retained across pagination.

## Product Images

Products can contain multiple ordered images. The current model defines limits for total product images and per-upload batches, while public product pages render a main image, thumbnails, and a full-screen gallery experience.

The application uses Laravel's public storage disk for managed product media.

## Demo Catalog Data

The repository includes a furniture catalog seeder with representative data for categories such as:

- Living Room
- Bedroom
- Dining
- Home Office
- Storage & Shelving

This seed data is intended to populate a useful development/showcase catalog and should not be interpreted as the production inventory state.

## Development

The repository defines a Composer setup workflow that installs backend and frontend dependencies, prepares the environment, runs migrations, and builds frontend assets.

Typical local commands are:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

For concurrent local development services, the project also defines:

```bash
composer dev
```

Environment-specific database, mail, application URL, and other secrets must be configured outside source control.

## Testing

Backend tests can be executed through the Composer test script:

```bash
composer test
```

The presence of test configuration does not by itself mean the current branch has been runtime-verified in every environment. Build, migration, and test results should be evaluated independently from this repository documentation.

## Deployment

The repository contains a GitHub Actions production deployment workflow that runs on pushes to `main` and deploys to the configured server over SSH using repository secrets.

The production workflow installs Composer dependencies, installs and builds frontend dependencies, runs Laravel cache optimizations and migrations, ensures the storage link, updates permissions, and reloads the configured PHP-FPM and Nginx services.

No deployment credentials are stored in this README; infrastructure secrets belong in GitHub repository secrets and the server environment.

## Project Scope

This repository should be described as a **furniture catalog and administration platform**, not as a complete transactional e-commerce system. The verified application provides catalog browsing, product management, filtering, imagery, pricing, and direct customer contact, while a cart, payment checkout, and order-management workflow are not part of the currently verified repository scope.

---

Built as a focused business storefront with a manageable catalog backend and a production deployment workflow.