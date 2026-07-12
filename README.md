# Web-Based Personal Financial Management System

A full-stack web application for tracking personal income and expenses, built with Laravel. Users can register, log in, and manage their own financial transactions through a personal dashboard.

## Features

- **User authentication** — registration, login, email verification, password reset, and profile management (powered by Laravel Breeze)
- **Transaction management (CRUD)** — create, view, edit, and delete income/expense transactions, each with a title, amount, type, category, description, and date
- **Personal dashboard** — real-time summary of total income, total expenses, and the 5 most recent transactions
- **User-scoped data** — every transaction is tied to the logged-in user, with authorization checks preventing access to other users' data

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.1, Laravel 10 |
| Frontend | Blade, Tailwind CSS, Alpine.js |
| Build tool | Vite |
| Database | MySQL |
| Auth | Laravel Breeze |

## Getting Started

### Prerequisites
- PHP 8.1+
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
# Clone the repo
git clone https://github.com/wengheng0201/Web-Based-Personal-Financial-Management-System.git
cd Web-Based-Personal-Financial-Management-System

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy the environment file and generate an app key
cp .env.example .env
php artisan key:generate
```

Then open `.env` and set your database credentials:

```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations and start the app:

```bash
php artisan migrate
npm run dev
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Project Structure

```
app/Http/Controllers/       # Auth, Dashboard, Profile, Transaction controllers
app/Models/                 # User, Transaction
database/migrations/        # Users & transactions schema
resources/views/            # Blade templates
routes/web.php              # Application routes
```
