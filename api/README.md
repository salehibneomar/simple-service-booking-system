## 📋 Project Overview

The Simple Service Booking System API is a Laravel-based RESTful API that provides a comprehensive booking management system. This API allows customers to browse and book services while providing administrators with full control over service management and booking administration.

## 📋 System Requirements

### Software Dependencies

-   **PHP**: Version 8.2 or higher
-   **Composer**: Latest version
-   **MySQL**: Version 8.0 or higher
-   **Laravel Framework**: Version 12.0

### Additional Tools (Optional)

-   **Laragon** or **Laravel Herd** for local development
-   **Postman** for API testing

## 🚀 Installation & Setup

### 1\. Clone the Repository

```bash
git clone repo-name
cd folder/api

```

### 2\. Install Dependencies

```bash
composer install

```

### 3\. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env
# Generate application key
php artisan key:generate

```

### 4\. Database Setup

Update your `.env` file with your database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simple_service_booking_system
DB_USERNAME=your_username
DB_PASSWORD=your_password

```

### 5\. Run Database Migrations & Seeders

```bash
# Run migrations
php artisan migrate
# Seed the database with sample data
php artisan db:seed

```

### 6\. Optimize Application

```bash
php artisan optimize

```

### 7\. Start the Development Server

```bash
# Using Laravel's built-in server
php artisan serve
# The application will be available at: http://127.0.0.1:8000 or 8080

```

**Note**: If you're using Laragon or Laravel Herd, you can access the application directly through their provided endpoints.

## 🔐 Default User Credentials

After running the database seeder, you'll have access to:

### Admin Account

-   **Email**: `admin@example.com`
-   **Password**: `123456`
-   **Role**: Admin

### Customer Accounts

-   10 customer accounts are created automatically
-   **Password**: `123456` (for all customers)
-   **Role**: Customer

### Services

-   200+ Demo services

### Content-Type Headers

-   Use `Content-Type: application/json` for all requests
-   Use `Accept: application/json` for JSON responses

## 🔗 API Routes

### Authentication Routes

-   `POST /api/login` - User login (Admin/Customer)
-   `POST /api/register` - User registration
-   `POST /api/logout` - User logout (requires authentication)

### Service Management Routes

-   `GET /api/services` - List all services (authenticated users - Admin gets to see all, and customer gets to see only the available services)
-   `POST /api/services` - Create new service (Admin only)
-   `PUT /api/services/{id}` - Update service (Admin only)
-   `DELETE /api/services/{id}` - Delete service (Admin only)

### Booking Management Routes

#### Admin Booking Routes

-   `GET /api/admin/bookings` - Get all bookings (Admin only)
-   `PUT /api/admin/bookings/{id}` - Update booking status (Admin only)

#### Customer Booking Routes

-   `GET /api/bookings` - Get customer's bookings (Customer only)
-   `POST /api/bookings` - Create new booking (Customer only)

### Common Issues

1. **Authentication Errors**

    - Ensure Bearer token is correctly set
    - Verify token hasn't expired
    - Check user role permissions

2. **Database Connection Issues**

    - Verify database credentials in `.env`
    - Ensure MySQL service is running
    - Check database exists

3. **Permission Errors**

    - Run `php artisan optimize:clear`
    - Check file permissions
    - Verify storage directory is writable
