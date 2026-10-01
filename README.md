# LearnPHP

Independent LearnPHP blog application with the original MVC-style layout, Bootstrap interface, theme switcher, posts and users screens, and SQLite storage.

## MVP scope

The MVP is a small standalone blog that can be started locally without relying on the original project folder or its database.

- Visitors can browse the World and U.S. article pages and switch between light, dark, and automatic themes.
- Visitors can register, sign in, and sign out; passwords are stored as hashes.
- Signed-in users can create, view, edit, and delete posts.
- The user screens provide create, list, view, edit, and delete operations.
- SQLite data is stored in this project folder, and the required tables are created automatically.

MVP acceptance checks: the home page and local assets load; registration and login create a session; post and user CRUD screens use the local database; starting the app from this folder does not read or modify the original project's files.

## Requirements

- PHP 8.2 or newer with the `pdo_sqlite` extension enabled
- Composer (optional for the built-in App autoloader; use it to install the dependencies listed in `composer.json`)

## Run on Windows

From this folder, run `server.ps1` in PowerShell, or start the server directly:

```powershell
php -S 127.0.0.1:8000 -t public public/index.php
```

Open `http://127.0.0.1:8000`. The first database request creates `db.sqlite` and the required tables in this project folder. The database path is independent of the shell's current directory.

To install Composer dependencies first, run `composer install`. The application can also use its local PSR-4 autoloader when `vendor/autoload.php` has not been generated.

## Run on macOS/Linux

From this folder, run `sh server.sh`.