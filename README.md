# Laravel Notes and Modules Management System

A Laravel-based web application for managing student notes and modules.

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM

## Installation

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   npm install
   ```
4. Copy `.env.example` to `.env` and configure your database settings
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Run database migrations:
   ```bash
   php artisan migrate
   ```

## Running the Application

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```
2. Compile assets:
   ```bash
   npm run dev
   ```

## Features

- Student management
- Module management
- Grade tracking
- User authentication
- Role-based access control

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
