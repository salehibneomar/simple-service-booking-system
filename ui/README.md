# Simple Service Booking System - Frontend UI

A modern, responsive web application built with Nuxt 3 for managing service bookings. This frontend provides an intuitive interface for users to browse services, make bookings, and manage their accounts.

## 🚀 Tech Stack

- **Framework**: [Nuxt 3](https://nuxt.com/) - Vue.js framework for production
- **State Management**: [Pinia](https://pinia.vuejs.org/) - The Vue Store that you will enjoy using
- **UI Framework**: [Quasar](https://quasar.dev/) - Vue.js based framework with Material Design 2.0
- **HTTP Client**: [Axios](https://axios-http.com/) - Promise based HTTP client
- **Language**: Vue 3 with Composition API and TypeScript support

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **Node.js**: Version 18.0.0 or higher
- **pnpm**: Version 8.0.0 or higher (recommended package manager)

You can check your versions with:

```bash
node --version
pnpm --version
```

If you don't have pnpm installed, you can install it globally:

```bash
npm install -g pnpm
```

## 🛠️ Installation & Setup

1. **Clone the repository** (if not already done):

   ```bash
   git clone <repository-url>
   cd folder/ui
   ```

2. **Install dependencies**:

   ```bash
   pnpm install
   ```

3. **Environment Configuration**:
   Copy the example environment file and configure it for your local setup:

   ```bash
   cp example.env .env
   ```

   All environment variables are prefixed with `VITE_` to be available in the client:

   - `VITE_API_BASE_URL` - Backend API base URL
   - `VITE_SITE_URL` - Frontend application URL
   - `VITE_APP_NAME` - Application name
   - `VITE_APP_VERSION` - Current version
   - `VITE_APP_DESCRIPTION` - Application description
   - `VITE_APP_AUTHOR` - Application author

4. **Start the development server**:

   ```bash
   pnpm run ui
   ```

   The application will be available at `http://localhost:3000`

## 📁 Project Structure

```
ui/
├── assets/               # Static assets and utilities
├── components/           # Reusable Vue components
│   ├── Booking/         # Booking-related components
│   └── Service/         # Service-related components
├── composables/          # Vue composables for shared logic
├── layouts/              # Application layouts
├── middleware/           # Route middleware
├── pages/                # File-based routing pages
│   ├── admin/           # Admin-specific pages
│   └── auth/            # Authentication pages
├── plugins/              # Nuxt plugins
├── public/               # Static files served directly
├── server/               # Server-side code
├── services/             # API service layers
├── stores/               # Pinia stores for state management
└── utils/                # Utility functions
```
