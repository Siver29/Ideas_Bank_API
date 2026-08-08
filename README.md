# Syrian Investment Ideas Bank

A public REST API for displaying Syrian investment ideas and their details. This is a small educational MVP built with **Laravel 12** to practice consuming a Laravel REST API from a separate frontend.

## Overview

The backend exposes **public** REST APIs for:

- Listing active investment projects
- Viewing a single active investment project
- Listing investment categories
- Viewing a single investment category
- Listing Syrian governorates
- Viewing a single governorate
- Listing governorate cities
- Viewing a single city
- Returning machinery requirements for each project
- Returning project location coordinates
- Returning project images when available

The frontend receives the complete active project list and performs **search, filtering, sorting, and pagination locally**. Favorites are also managed locally on the frontend.

## Scope

This is a **backend-only** educational MVP. It intentionally does **not** include:

- Authentication or user registration
- Users, roles, or permissions
- An admin dashboard or CRUD management APIs
- Favorites, search, filter, sort, or pagination APIs
- Reviews, comments, or payments
- Prospective investor contact requests

## Requirements

- PHP 8.2+
- Composer
- SQLite (or MySQL) for a quick local start

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Running Tests

```bash
php artisan test
```

## Code Style

```bash
vendor/bin/pint
```

## API Conventions

All endpoints are versioned under `/api/v1` and are publicly accessible (no authentication).

### Response format

**Success (single resource):**

```json
{
  "success": true,
  "message": "Operation successful.",
  "data": {}
}
```

**Error (e.g. not found):**

```json
{
  "success": false,
  "message": "Resource not found."
}
```

## Project Structure

```
app/
├── Enums/                 # domain enums (kept empty until the ideas phase)
├── Http/
│   ├── Controllers/Api/V1/  # public API controllers
│   ├── Middleware/
│   ├── Requests/            # Form Request validation classes
│   ├── Resources/           # API Resources
│   └── Responses/           # ApiResponse trait
├── Models/                 # Eloquent models
└── Providers/
database/
├── factories/
├── migrations/
└── seeders/
tests/
└── Feature/               # Feature tests
```

## Reusable Infrastructure

- `/api/v1` route versioning
- Consistent JSON response format (`app/Http/Responses/ApiResponse.php`)
- Global API exception handling (`bootstrap/app.php`)
- API Resource conventions
- Form Request conventions
- CORS configuration (`config/cors.php`)
- Local public file-storage configuration (`config/filesystems.php`)
- Feature-testing conventions

## Roadmap

The investment ideas domain (projects, categories, governorates, and cities) will be implemented in the next phase.
