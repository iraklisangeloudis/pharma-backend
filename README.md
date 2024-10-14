<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Pharmaceutical Product Management Backend

This is the backend for the Pharmaceutical Product Management system, built with Laravel and Docker using Laravel Sail.

## Prerequisites

- Docker
- Docker Compose
- WSL2 (for Windows users)

## Setup

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/pharma-backend.git
   cd pharma-backend
   ```

2. Copy the `.env.example` file to `.env` and modify the database credentials if needed:
   ```
   cp .env.example .env
   ```
   
   ```
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=pharmaceutical_db
   DB_USERNAME=sail
   DB_PASSWORD=password
   ```

3. Install dependencies using Laravel Sail:
   ```
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
   ```

4. Start the Docker environment:
   ```
   ./vendor/bin/sail up -d
   ```

5. Generate application key:
   ```
   ./vendor/bin/sail artisan key:generate
   ```

6. Run database migrations:
   ```
   ./vendor/bin/sail artisan migrate
   ```

## API Endpoints

- `GET /api/products`: List all products
- `POST /api/products`: Create a new product
- `GET /api/products/{id}`: Get a specific product
- `PUT /api/products/{id}`: Update a specific product
- `DELETE /api/products/{id}`: Delete a specific product

## Testing

Run the tests using:
```
./vendor/bin/sail artisan test
```

## Database Seeding

```
./vendor/bin/sail artisan db:seed --class=ProductSeeder
```

## Frontend

The frontend for this project is being developed separately. You can find it at:

[Frontend Repository](https://github.com/iraklisangeloudis/pharma-frontend) (placeholder link)

## License

[MIT License](LICENSE)
