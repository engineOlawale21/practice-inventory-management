# Practice Inventory Management

A small inventory management application built with Laravel. It manages products, categories, purchases, sales, clients, suppliers, payments, and basic invoicing.

## Key Features

- Product & category management
- Purchases, sales and payment records
- Clients and suppliers management
- Invoices, delivery notes and credit notes
- Seeders for sample data (see database/seeders)

## Requirements

- PHP 8.1+ (or the version required by the included Laravel setup)
- Composer
- Node.js (18+) and npm/yarn
- A relational database (MySQL, MariaDB, or PostgreSQL)

## Quick Setup

1. Clone the repo and enter the directory:

	git clone <repo-url> && cd practice-inventory-management

2. Copy the environment file and set your environment variables:

	cp .env.example .env
	(update `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

3. Install PHP dependencies:

	composer install

4. Install JS dependencies and build assets:

	npm install
	npm run dev

5. Generate application key:

	php artisan key:generate

6. Run migrations and seeders:

	php artisan migrate --seed

	To seed only clients, run: `php artisan db:seed --class=ClientsSeeder`

7. Create the storage link (for profile photos and uploads):

	php artisan storage:link

8. Start the development server:

	php artisan serve

## Database Seeders

Sample seeders live in `database/seeders`, for example `database/seeders/ClientsSeeder.php`.
Run `php artisan migrate --seed` to populate the database with starter data.

## Running Tests

This project uses Pest/PHPUnit for testing. Run the test-suite with:

```
php artisan test
```

Or with Pest directly:

```
./vendor/bin/pest
```

## Project Structure (high level)

- `app/Models` — Eloquent models (Product, Client, Supplier, Sale, Purchase, etc.)
- `app/Http/Controllers` — HTTP controllers
- `database/migrations` — database schema
- `database/seeders` — seeders for sample data
- `resources/views` — Blade templates
- `routes/web.php` — application routes

## Environment & Configuration

Ensure the following environment variables are set in your `.env` file:

- `APP_URL` — application URL
- `DB_*` — database configuration
- `MAIL_*` — mail settings for notifications

## Contributing

Contributions are welcome. Please open an issue for larger changes or a pull request with a clear description of your changes.

## License

This project is open-sourced software licensed under the MIT license.
