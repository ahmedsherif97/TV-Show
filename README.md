# SHOW.TV – TV Shows & Episodes Platform

SHOW.TV is a simple Laravel application that allows registered users to browse TV shows, view episodes, and interact with them (follow shows, like/dislike episodes, etc.).  
An admin panel is included to manage TV shows and episodes.

---

## 🔧 Requirements

- PHP 8.x
- Composer
- MySQL (or compatible)
- Node.js & npm (only if you want to recompile assets)
- Git (optional, for cloning)

---

## 🚀 Installation & Setup

Follow these steps to run the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/ahmedsherif97/TV-Show.git
   cd TV-Show

composer install

cp .env.example .env

copy .env.example .env

php artisan key:generate


- DB_DATABASE=your_database_name.
- DB_USERNAME=your_database_user.
- DB_PASSWORD=your_database_password.


php artisan migrate

php artisan db:seed

php artisan storage:link

---------------------------
## Admin Url:
{APP_URL}/admin/login

# Default Admin Credentials:
- Email:    admin@admin.com
- Password: 123456789

--------------------------------
👤 Frontend (User Side)

Register a new user account or log in:

http://localhost:8000/register

http://localhost:8000/login

Browse TV shows and episodes.

View episode details (thumbnail, video, description, duration, airing time).

Follow / unfollow TV shows.

Like / dislike episodes.

Use the navbar to:

Search for shows/episodes.

Access homepage.

Access random TV shows links.

-------------------------------
Through the admin panel (/admin/login) the admin can:

View users.

Create / View / Edit / List TV shows.

Create / View / Edit / List episodes.

Manage show schedules (airing days and times).

## UI Ref: https://themewagon.com/themes/free-responsive-bootstrap-5-html5-admin-template-sneat/