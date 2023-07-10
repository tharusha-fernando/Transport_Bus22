<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Smart Transportation System API

The Smart Transportation System API is designed to manage the public transportation system in Sri Lanka. It has the following main user types:

- Admin
- Station Operator
- Driver
- General User

The API provides the following features:

- Manage timetables for bus routes
- Track buses and provide live locations
- Manage drivers and buses data related to their work

## Project Setup

To set up the project, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/tharusha-fernando/Transport_Bus_Capstone_Prohect.git

3. Install project dependencies using Composer:
   ```bash
   composer install


4. Run database migrations:
   ```bash
   php artisan migrate

5. Start the development server:
    ```bash
   php artisan serve



The API will be accessible at http://localhost:8000.

Postman Collection
Inside the public/postman directory, you will find a Postman collection that contains pre-defined API requests. You can import this collection into Postman to easily test and interact with the API.
This projects currently uses Sanctum Authentication

css
Copy code

Copy the above content and save it as a markdown file (e.g., `readme.md`) in your GitHub repository.






