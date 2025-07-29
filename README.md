# Simple Service Booking System

A simple full-stack web application for managing service bookings with a modern tech stack. This system allows users to browse services, make bookings, and provides administrative capabilities for service providers.

## 🌟 Overview

The Simple Service Booking System consists of two main components:

- **Backend API** - Laravel-based REST API providing robust data management and authentication
- **Frontend UI** - Nuxt 3-based modern web interface with responsive design

## 🎥 Demo Video

Watch the application in action:

[![Simple Service Booking System Demo](https://img.youtube.com/vi/lmhR__9-Yww/maxresdefault.jpg)](https://youtu.be/lmhR__9-Yww)

## 📁 Project Structure

```
simple-service-booking-system/
├── api/                  # Backend API (Laravel 12)
│   ├── app/             # Application logic, models, controllers
│   ├── database/        # Migrations, seeders, factories
│   ├── routes/          # API and web routes
│   └── config/          # Application configuration
└── ui/                   # Frontend UI (Nuxt 3)
    ├── components/      # Reusable Vue components
    ├── pages/           # File-based routing pages
    ├── stores/          # Pinia state management
    └── services/        # API service layers
```

## 🛠️ Technology Stack

### Backend (API)

- **Framework**: Laravel 12
- **Language**: PHP 8.4
- **Database**: MySQL 8.0
- **Authentication**: Laravel Sanctum

### Frontend (UI)

- **Framework**: Nuxt 3
- **Language**: Vue 3
- **State Management**: Pinia
- **UI Framework**: Quasar
- **HTTP Client**: Axios

## 📋 System Requirements

### Backend Requirements

- **PHP**: Version 8.2 or higher
- **Composer**: Latest version
- **MySQL**: Version 8.0 or higher (or compatible database)
- **Web Server**: Apache, Nginx, or Laravel Herd (For easy installion)

### Frontend Requirements

- **Node.js**: Version 18.0 or higher
- **pnpm**: Version 8.0 or higher (recommended package manager)

## 🚀 Installation Guide

### 1. Clone the Repository

```bash
git clone <repository-url>
cd folder
```

### 2. Backend Setup (API)

1. **Navigate to the API directory:**

   ```bash
   cd api
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Environment Configuration:**

   ```bash
   cp .env.example .env
   ```

4. **Configure your `.env` file with your database credentials:**

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=simple_service_booking_system
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

6. **Run database migrations and seeders:**

   ```bash
   php artisan migrate --seed
   ```

7. **Start the backend server:**

   **Option A: Using Laravel's built-in server:**

   ```bash
   php artisan serve --port=8000
   ```

   **Option B: Using Laravel Herd (recommended):**

   - Install [Laravel Herd](https://herd.laravel.com/)
   - Connect your project directory
   - Access via `http://path-name.test`

### 3. Frontend Setup (UI)

1. **Navigate to the UI directory:**

   ```bash
   cd ../ui
   ```

2. **Install Node.js dependencies:**

   ```bash
   pnpm install
   ```

3. **Environment Configuration:**

   ```bash
   cp example.env .env
   ```

4. **Configure your `.env` file to match your backend setup:**

   ```env
   VITE_API_BASE_URL=http://127.0.0.1:8000/api
   VITE_SITE_URL=http://localhost:3000
   VITE_APP_NAME=SimpleServiceBookingSystem
   VITE_APP_VERSION=1.0.0
   VITE_APP_DESCRIPTION=Simple Service Booking System
   VITE_APP_AUTHOR=Saleh Ibne Omar
   ```

   **Important**: Make sure `VITE_API_BASE_URL` matches your backend server URL:

   - If using `php artisan serve`: `http://127.0.0.1:8000/api`
   - If using Laravel Herd: `http://path-name.test`
   - If using custom server: `https://your-domain.com/api`

5. **Start the frontend development server:**
   ```bash
   pnpm run ui
   ```

The application will be available at `http://localhost:3000`

## 📚 Documentation

- **Backend API Documentation**: See `api/README.md`
- **Frontend UI Documentation**: See `ui/README.md`
