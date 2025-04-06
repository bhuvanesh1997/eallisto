A simple admin portal built using Laravel 8 with manual authentication, customer and invoice management via AJAX and REST APIs.

- Manual login with AJAX
- Admin dashboard with sidebar navigation
- Customer management (List, Create, Edit)
- Invoice management (List, Create, Edit)
- Unified API endpoints for listing and saving records
- Database seeder for creating a default admin user


Clone the repository:
git clone https://github.com/bhuvanesh1997/eallisto.git
cd eallisto
composer install
npm install && npm run dev
cp .env.example .env
update the db name in .env
php artisan key:generate
php artisan migrate
php artisan db:seed

username : test@gmail.com
password : 123456

php artisan serve


Customers and Invoices can be managed from their respective sections.
All forms use AJAX for submission.
API endpoints:
GET /api/data - Returns customers and invoices
POST /api/save - Handles creation/editing for both models