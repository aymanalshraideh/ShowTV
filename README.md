# Show.Tv

A simple Laravel-based platform that allows registered users to watch TV shows and series.  
It includes an admin panel for managing content .

## Features

- User registration and authentication
- List of TV Shows and related Episodes
- Follow/Unfollow TV Shows
- Like/Dislike Episodes
- Search functionality
- Admin panel for managing TV Shows and Episodes
- Role-based access to protect admin routes
- Basic Bootstrap-based UI

---

## Demo Credentials

### Admin Login

- **Email:** `admin@example.com`
- **Password:** `password`

> The admin panel is restricted to users with admin access only.

### Normal User

You can register a new account from the **Register** page to use the platform as a regular user.

---

## Setup and Installation

Follow these steps to get the project running on your local machine:

```bash
git clone https://github.com/aymanalshraideh/ShowTV
cd ShowTv

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link

npm install
npm run dev

php artisan serve
