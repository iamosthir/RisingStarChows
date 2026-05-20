# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Laravel 12 application with dual frontend architecture: an admin panel using AdminLTE template and a public-facing frontend. Database name is `bengalclub`. Uses Vite with Tailwind CSS v4 for asset compilation.

## Essential Commands

### Development Setup
```bash
# Initial setup (installs dependencies, generates key, runs migrations, builds assets)
composer setup

# Start development servers (runs Laravel server, queue worker, and Vite concurrently)
composer dev
```

### Testing
```bash
# Run all tests
composer test

# Run specific test file
php artisan test --filter=TestClassName

# Run specific test method
php artisan test --filter=TestClassName::test_method_name

# Run tests with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Format specific file or directory
./vendor/bin/pint app/Models
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration (drop all tables and re-migrate)
php artisan migrate:fresh

# Run seeders
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Artisan
```bash
# Create controller
php artisan make:controller ControllerName

# Create model with migration
php artisan make:model ModelName -m

# Create model with migration, factory, and seeder
php artisan make:model ModelName -mfs

# Clear all caches
php artisan optimize:clear

# Create middleware
php artisan make:middleware MiddlewareName

# Create request validation
php artisan make:request RequestName
```

### Asset Compilation
```bash
# Build assets for production
npm run build

# Watch and recompile assets during development
npm run dev
```

### Queue
```bash
# Process queue jobs
php artisan queue:work

# Process queue with specific connection
php artisan queue:work database

# List failed jobs
php artisan queue:failed

# Retry failed job
php artisan queue:retry {id}
```

## Architecture

### Dual Layout System

The application has two separate frontend experiences:

**Admin Panel** (`resources/views/admin/`)
- Uses AdminLTE 3 template
- jQuery-based with Bootstrap 4
- Assets loaded from `public/dist/` and `public/plugins/`
- Layout: `admin/layouts/master.blade.php`
- Partials: `admin/partial/header.blade.php`, `admin/partial/footer.blade.php`

**Frontend** (`resources/views/frontend/`)
- Layout structure defined but currently minimal
- Layout: `frontend/layouts/master.blade.php`
- Partials: `frontend/partial/header.blade.php`, `frontend/partial/footer.blade.php`
- Uses Vite-compiled assets (Tailwind CSS v4)

### Database Configuration

- **Driver**: MySQL
- **Database**: `bengalclub`
- **Sessions**: Database-backed (table: `sessions`)
- **Cache**: Database-backed (table: `cache`)
- **Queue**: Database-backed (table: `jobs`)

All three tables need migrations run before using sessions, cache, or queues.

### Directory Structure

```
app/
├── Http/
│   └── Controllers/     # Application controllers
├── Models/              # Eloquent models (currently only User)
└── Providers/           # Service providers

resources/
├── views/
│   ├── admin/          # Admin panel views (AdminLTE)
│   └── frontend/       # Public-facing views
├── css/
│   └── app.css         # Tailwind CSS entry point
└── js/
    └── app.js          # JavaScript entry point

routes/
├── web.php            # Web routes (currently empty)
└── console.php        # Artisan commands

public/
├── dist/              # AdminLTE compiled assets
└── plugins/           # AdminLTE plugins (jQuery, Bootstrap, etc.)
```

### Asset Pipeline

**Admin Panel**: Uses pre-compiled AdminLTE assets from `public/dist/` and `public/plugins/`. These are traditional jQuery/Bootstrap-based assets loaded via `<script>` tags.

**Frontend**: Uses Vite with Tailwind CSS v4. Entry points are `resources/css/app.css` and `resources/js/app.js`. The Vite config excludes `storage/framework/views/**` from watch to avoid unnecessary rebuilds.

### Testing

PHPUnit configured with two test suites:
- `Unit`: `tests/Unit/`
- `Feature`: `tests/Feature/`

Test environment uses SQLite in-memory database for isolation.

## Development Workflow

1. **Adding Admin Features**: Create controllers, routes, and views under `admin/` directory. Use AdminLTE components and follow the existing jQuery/Bootstrap pattern.

2. **Adding Frontend Features**: Create controllers, routes, and views under `frontend/` directory. Use Tailwind CSS classes and Vite-compiled assets.

3. **Database Changes**: Always create migrations for schema changes. Run `php artisan migrate` after creating migrations.

4. **Queue Jobs**: Since queue connection is `database`, ensure migrations are run and use `php artisan queue:work` to process jobs during development.

5. **Code Style**: Run Laravel Pint before committing to ensure consistent code formatting.
