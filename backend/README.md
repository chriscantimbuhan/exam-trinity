# Trinity Exam

## Backend Setup

### Tech Requirements:

- PHP 7.4^
- SQLite
- NodeJS v20.*
- NPM v10.*
- Composer v2.*

### Steps:
Navigate to the project folder via terminal.
```sh
cd your_project_folder/backend
```
Copy or move env.sample to .env.
```sh
cp env.example .env
```
Install composer packages.
```sh
composer install
```
Generate application key
```sh
php artisan key:generate
```
Create SQLite database
```sh
touch database/trinity.sqlite
```
Run database migrations.
```sh
php artisan migrate
```
Clear cache (as needed)
```sh
php artisan cache:clear
```
Clear config (as needed)
```sh
php artisan config:clear
```
Run the server
```sh
php artisan serve
```