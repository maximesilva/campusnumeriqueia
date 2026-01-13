# Laravel Car CRUD API

This Laravel application provides a complete CRUD API for managing cars with Swagger documentation.

## Features

- Car model with full CRUD operations
- RESTful API endpoints
- Swagger/OpenAPI documentation
- Database seeding with fake data
- SQLite database

## Installation

1. Install dependencies:
```bash
composer install
npm install
```

2. Copy environment file:
```bash
cp .env.example .env
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Run migrations:
```bash
php artisan migrate
```

5. Seed the database with sample cars:
```bash
php artisan db:seed
```

6. Install dependencies and regenerate autoloader:
```bash
composer install
composer dump-autoload
```

7. Publish L5-Swagger config (if not already done):
```bash
php artisan vendor:publish --provider="L5Swagger\L5SwaggerServiceProvider"
```

8. Generate Swagger documentation:
```bash
php artisan l5-swagger:generate
```

## API Endpoints

All API endpoints are prefixed with `/api`:

- `GET /api/cars` - List all cars
- `POST /api/cars` - Create a new car
- `GET /api/cars/{id}` - Get a specific car
- `PUT /api/cars/{id}` - Update a car
- `DELETE /api/cars/{id}` - Delete a car

## Swagger Documentation

Access the Swagger UI at: `http://localhost:8000/api/documentation`

## Running the Application

Start the development server:
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## Car Model Fields

- `make` (string) - Car manufacturer
- `model` (string) - Car model name
- `year` (integer) - Manufacturing year
- `color` (string) - Car color
- `price` (decimal) - Car price

## Example API Usage

### Create a Car
```bash
curl -X POST http://localhost:8000/api/cars \
  -H "Content-Type: application/json" \
  -d '{
    "make": "Toyota",
    "model": "Corolla",
    "year": 2020,
    "color": "Red",
    "price": 15000.00
  }'
```

### Get All Cars
```bash
curl http://localhost:8000/api/cars
