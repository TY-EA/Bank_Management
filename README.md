# Bank Management (Laravel)

Bank Management is a sample banking management application built with Laravel 9. It provides CRUD operations for clients and accounts (comptes) as well as fund transfers (virements) between accounts, a basic authentication flow and a dashboard interface.

---

## Table of Contents

-   [Features](#features)
-   [Tech Stack](#tech-stack)
-   [Requirements](#requirements)
-   [Installation & Setup](#installation--setup)
-   [Database & Seeding](#database--seeding)
-   [Running (Local Development)](#running-local-development)
-   [API / Routes Summary](#api--routes-summary)
-   [Testing](#testing)
-   [Contributing](#contributing)
-   [License](#license)

---

## Features

-   User authentication (login/logout)
-   Client management: create, edit, delete, show
-   Account management (Compte): create, edit, delete, show, relationship with clients
-   Virements (bank transfers): validation, transactional debiting/crediting, and virement history
-   Dashboard access guarded by authentication

## Tech Stack

-   PHP 8.0+
-   Laravel 9
-   Vite + Laravel Vite Plugin
-   MySQL (or any database supported by Laravel)
-   Composer, NPM

## Requirements

-   PHP 8.0 or greater
-   Composer
-   Node >= 16 (for Vite)
-   A running database (MySQL, Postgres, or use SQLite for testing)

## Installation & Setup

1. Clone the repository

```bash
git clone https://github.com/Bank-Management-Laravel/Bank_Management.git
cd Bank_Management/Bank_Management
```

2. Install PHP dependencies

```bash
composer install
```

3. Install frontend dependencies

```bash
npm install
```

4. Copy `.env.example` to `.env` and set your environment variables

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` to configure your database credentials and other environment values (e.g., APP_URL, DB_CONNECTION, DB_USERNAME, DB_PASSWORD).

5. Run migrations and seeders

```bash
php artisan migrate --seed
```

If you don't want to seed sample data, run `php artisan migrate` instead.

---

## Database & Seeding

-   `migrations/` defines tables for `clients`, `comptes`, and `virements`.
-   There is a `UserSeeder` that creates a sample user used for authentication:

```
email: aya@gmail.com
password: 12345678
```

You can add additional seeders to populate `clients`, `comptes`, or `virements` for testing.

---

## Running (Local Development)

1. Start Vite for frontend assets

```bash
npm run dev
```

2. Start the Laravel development server

```bash
php artisan serve
```

Open `http://127.0.0.1:8000` and login with the seeded user.

### Optional: Using Laravel Sail (Docker)

If you want to run with Sail and Docker, make sure you have Docker installed then:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
```

---

## API / Routes Summary

The application exposes the following main web routes (defined in `routes/web.php`):

-   `GET /login` - show login form
-   `POST /login` - submit credentials
-   `POST /logout` - logout user
-   `GET /dashboard` - authenticated dashboard page
-   Resource controllers (CRUD operations):
    -   `/clients` -> `ClientController`
    -   `/comptes` -> `CompteController`
    -   `/virements` -> `VirementController`

Virement creation enforces checking the source account balance and does the database operations inside a transaction to maintain integrity.

---

## Testing

Run tests with PHPUnit or the Laravel test runner:

```bash
php artisan test
# or
vendor/bin/phpunit
```

## Environment Variables

Important variables in `.env`: `APP_NAME`, `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `MAIL_*` for mailing.

## Contributing

Contributions are welcome! Please open an issue for a feature or bug report, and feel free to submit a PR with a clear description of the problem and a test if possible.

Guidelines:

-   Follow PSR-12 for PHP code styling
-   Use `composer test` and `php artisan test` to validate changes

---

## License

This project is distributed under the MIT license.
