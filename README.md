# Laravel Book Management System

A simple CRUD (Create, Read, Update, Delete) application built with **Laravel 11** and **MySQL** for managing a collection of books and their associated images.

## Features

- Create new book entries with title, author, publication year, and images
- View a list of all books with their details and images
- Edit existing book information
- Delete books from the system
- Validation on all input fields
- Images stored in a separate table with foreign key relationships to books

## Technologies Used

- PHP 8.x
- Laravel 12
- MySQL (via XAMPP or similar)
- Blade templating for UI
- Git for version control

## Setup Instructions

1. Clone this repository:
   ```bash
   git clone https://github.com/yourusername/laravel-book-management-system.git
   cd laravel-book-management-system

## Install dependencies:

composer install
npm install
npm run dev

## Update .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password

## Generate application key:
php artisan key:generate

## Run the database migrations:
php artisan migrate

## Serve the application locally:
php artisan serve
