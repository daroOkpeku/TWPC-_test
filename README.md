# E-Commerce Application

A Laravel-based e-commerce application with user authentication, product management, and admin functionality.

## Features

### Authentication & Authorization
- User registration and login
- Role-based access control (Admin/User roles)
- User blocking functionality
- Password hashing and security

### Product Management
- CRUD operations for products
- Soft deletion support
- Product-user relationships
- Product search and filtering

### Admin Dashboard
- User management (view, block/unblock)
- Product oversight
- Admin-specific dashboard
- Product deletion capabilities

### Frontend
- Responsive design with Bootstrap 5
- Tailwind CSS for styling
- Vite for asset compilation
- Blade templating engine

## Tech Stack

### Backend
- **PHP 8.2+**
- **Laravel 12.0** - PHP Framework
- **Spatie Laravel Permission 6.24** - Role-based permissions
- **MySQL** - Database

### Frontend
- **Bootstrap 5** - CSS Framework
- **Tailwind CSS 4.0** - Utility-first CSS
- **Vite 7.0** - Build tool
- **Axios** - HTTP client

### Development Tools
- **PHPUnit** - Testing framework
- **Laravel Pint** - Code style fixer
- **Laravel Sail** - Docker development environment
- **Faker** - Test data generation

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- Database (MySQL)

### Quick Setup
```bash
# Clone the repository
git clone <repository-url>
cd e-commerce

# Run the automated setup script
composer run setup
```

### Manual Setup
```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate
php artisan db:seed

# Build assets
npm run build
```

## Database Structure

### Users Table
- `id` - Primary key
- `name` - User name
- `email` - User email (unique)
- `password` - Hashed password
- `is_blocked` - Boolean for user status
- `email_verified_at` - Email verification timestamp
- `remember_token` - Authentication token
- `created_at`, `updated_at` - Timestamps

### Products Table
- `id` - Primary key
- `name` - Product name
- `description` - Product description
- `price` - Product price
- `user_id` - Foreign key to users
- `deleted_at` - Soft deletion timestamp
- `created_at`, `updated_at` - Timestamps

### Permission Tables
- Roles and permissions management via Spatie package

## Application Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminController.php     # Admin dashboard and management
│   │   ├── ProductController.php   # Product CRUD operations
│   │   ├── HomeController.php      # Home page logic
│   │   └── Auth/                   # Authentication controllers
│   ├── Middleware/                 # Custom middleware
│   └── Requests/                   # Form request validation
├── Models/
│   ├── User.php                   # User model with roles
│   └── Product.php                # Product model
└── Providers/                     # Service providers

database/
├── migrations/                    # Database migrations
├── seeders/                       # Database seeders
└── factories/                     # Model factories

resources/
├── views/                         # Blade templates
│   ├── admin/                     # Admin panel views
│   ├── auth/                      # Authentication views
│   └── layouts/                   # Layout templates
├── css/                           # Compiled CSS
├── js/                            # JavaScript files
└── sass/                          # SCSS source files

routes/
└── web.php                        # Web routes definition

tests/
├── Feature/                       # Feature tests
└── Unit/                          # Unit tests
```

## User Roles & Permissions

### Admin Role
- Access to admin dashboard (`/admin/dashboard`)
- User management (`/admin/users`)
- Block/unblock users
- View all products (`/admin/products`)
- Delete products
- Full system oversight

### User Role
- Product CRUD operations (`/products`)
- Dashboard access (`/dashboard`)
- View and manage own products
- Standard user functionality

## API Routes

### Public Routes
- `GET /` - Welcome page (auth check middleware)
- Authentication routes (`/login`, `/register`, `/logout`)

### User Routes (Authenticated)
- `GET /dashboard` - User dashboard
- Resource routes for products:
  - `GET /products` - Index
  - `POST /products` - Store
  - `GET /products/{product}` - Show
  - `PUT /products/{product}` - Update
  - `DELETE /products/{product}` - Delete

### Admin Routes (Admin Role)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - User management
- `POST /admin/users/{user}/toggle-block` - Toggle user block
- `GET /admin/products` - Product oversight
- `GET /admin/products/{product}` - Product details
- `DELETE /admin/products/{product}` - Delete product

## Database Seeding

The application includes several seeders to populate the database with initial data:

### Available Seeders

#### DatabaseSeeder
Main seeder that calls all other seeders in the correct order:
- `ProductSeeder` - Creates sample products
- `CreateSuperAdminSeeder` - Creates admin user and roles
- `PermissionSeeder` - Sets up permissions and assigns them to admin
- `UserPermissionSeeder` - Sets up user-specific permissions
- `UpdateSuperadminPermission` - Updates superadmin permissions

#### CreateSuperAdminSeeder
- Creates default admin role and user role
- Creates super admin user with credentials:
  - **Email:** admin@example.com
  - **Password:** password
- Assigns admin role to the super admin user

#### ProductSeeder
- Creates 10 sample products
- Uses Faker for realistic data generation
- Assigns all products to the first available user

#### PermissionSeeder
- Creates admin permissions:
  - `view_users` - View user management
  - `block_unblock_users` - Block/unblock users
  - `view_product` - View products
  - `delete_product` - Delete products
- Assigns all permissions to the admin role

### Running Seeders

```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=ProductSeeder

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Refresh database and seed
php artisan migrate:refresh --seed
```

## Docker & Laravel Sail

The application includes Docker support via Laravel Sail for consistent development environments.

### Docker Configuration
- **compose.yaml** - Docker Compose configuration
- **Runtime:** PHP 8.5
- **Database:** MySQL 8.4
- **Web Server:** Nginx (via Laravel Sail)

### Services

#### Laravel Application
- **Image:** sail-8.5/app
- **Ports:** 80 (HTTP), 5173 (Vite)
- **Volumes:** Current directory mounted to /var/www/html
- **Environment:** Laravel Sail enabled

#### MySQL Database
- **Image:** mysql:8.4
- **Port:** 3306 (configurable via FORWARD_DB_PORT)
- **Database:** Configurable via DB_DATABASE
- **Health Check:** MySQL ping command

### Using Laravel Sail

```bash
# Install Sail (first time only)
composer require laravel/sail --dev
php artisan sail:install

# Start all services
./vendor/bin/sail up

# Start in detached mode
./vendor/bin/sail up -d

# Stop services
./vendor/bin/sail down

# Execute commands in container
./vendor/bin/sail php artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail composer install

# Access shell
./vendor/bin/sail shell

# View logs
./vendor/bin/sail logs
```

### Environment Variables for Docker
- `APP_PORT` - Application port (default: 80)
- `VITE_PORT` - Vite dev server port (default: 5173)
- `FORWARD_DB_PORT` - MySQL port forwarding (default: 3306)
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password
- `WWWUSER` - User ID for file permissions
- `WWWGROUP` - Group ID for file permissions

## Testing

The application includes comprehensive test coverage using PHPUnit.

### Test Structure

#### Feature Tests
- **LoginTest.php** - Authentication functionality
  - `test_user_can_login()` - Valid login test
  - `test_user_cannot_login_with_invalid_data()` - Invalid login test
- **RegistrationTest.php** - User registration
  - `test_user_can_register()` - Valid registration test
  - `test_user_cannot_register_with_invalid_data()` - Invalid registration test
- **ExampleTest.php** - Basic application test

#### Test Traits
- `RefreshDatabase` - Refreshes database between tests
- `WithFaker` - Provides Faker for test data generation

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/LoginTest.php

# Run specific test method
php artisan test --filter test_user_can_login

# Run with coverage
php artisan test --coverage

# Run in verbose mode
php artisan test --verbose

# Stop on first failure
php artisan test --stop-on-failure

# Run tests in parallel
php artisan test --parallel
```

### Test Database

Tests use a separate database configuration:
- Uses SQLite in-memory database by default
- Database is refreshed between tests via RefreshDatabase trait
- Seeders can be used for test data setup

### Writing Tests

```bash
# Create new feature test
php artisan make:test ProductTest

# Create new unit test
php artisan make:test UserServiceTest --unit

# Run test with specific environment
php artisan test --env=testing
```

### Test Best Practices
- Use factories for test data creation
- Test both success and failure scenarios
- Use assertions to verify expected behavior
- Keep tests independent and isolated
- Use descriptive test method names

## Development

### Running the Application
```bash
# Development server with all services
composer run dev

# Using Docker Sail
./vendor/bin/sail up -d

# Individual services
php artisan serve                    # Laravel server
npm run dev                         # Vite dev server
php artisan queue:listen            # Queue worker
php artisan pail                    # Log viewer
```

### Testing
```bash
# Run all tests
composer run test

# Individual test suites
php artisan test                    # PHPUnit tests
```

### Code Quality
```bash
# Code style fixing
./vendor/bin/pint

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

## Default Credentials

### Super Admin
- **Email:** admin@example.com
- **Password:** password

## Security Features

- Password hashing using Laravel's built-in hashing
- CSRF protection on all forms
- Role-based access control
- Input validation and sanitization
- SQL injection prevention via Eloquent ORM
- User blocking functionality

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and code quality checks
5. Submit a pull request

## License

This project is licensed under the MIT License.