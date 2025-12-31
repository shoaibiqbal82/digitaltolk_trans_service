# Translation Management Service (Laravel)

## Objective
Build a Translation Management Service to evaluate your ability to write clean,
scalable, and secure code, with a focus on performance.

## Task
Store translations for multiple locales (e.g., en , fr , es ) with the ability to add new
languages in the future.
### Done
Tag translations for context (e.g., mobile , desktop , web ).
### Done
Expose endpoints to create, update, view, and search translations by tags, keys, or
content.
### Done
POST /api/translations - Create
PUT /api/translations/{id} - Update
GET /api/translations/{id} - View a single translation
GET /api/translations - Search
/api/translations?key=
/api/translations?content=
/api/translations?tag=

Provide a JSON export endpoint to supply translations for frontend applications like
Vue.js.
### Done
GET /api/export/{locale}

Json endpoint should always return updated translations whenever requested.
### Done
cahce invalidated upon update in translationservice

## Performance Requirements
Response time for all endpoints should be in milliseconds. i.e < 200ms
### Done
Provide a command or factory to populate the database with 100k+ records for
testing scalability.
### Done - php artisan db:seed --class=TranslationSeeder

The JSON export endpoint should handle large datasets efficiently and return
responses in less than 500ms.
### Done - php artisan test --filter=test_export_100k_translations_under_500ms
initial hit after cache invalidated is costly but not much, subsequent hits are under 500ms


## Technical Requirements
Follow PSR-12 standards and use a scalable database schema.
### Done
Follow SOLID design principles.
### Done
Optimized sql queries.
### Done
Implement token-based authentication to secure the API.
### Done
No external libraries for CRUD or translation services should be used.
### Not used

## Plus points
Docker setup.
CDN support.
### Done - cahing mechanism implemented wihch will work with CDN providers
Test coverage > 95%
### Done
OpenAPI or swagger documentation for API.
Write unit and feature tests for all critical functionalities, including performance
testing.
### Done

# Setup

### 1. Clone repo:
    git clone <repo-url>
    cd translation-service

### 2. Install dependencies:
    composer install
   
### 3. Set up environment:
    cp .env.example .env
    php artisan key:generate

### 4. Configure your database in .env and run migrations:
    php artisan migrate:fresh

### 5. Seeder / Factory for 100k+ Records
    php artisan db:seed --class=TranslationSeeder

### 6. Serve locally
    php artisan serve
