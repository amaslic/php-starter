# 🚀 PHP Starter API with Router, JWT Auth & MySQL

A modular PHP REST API starter boilerplate with routing, middleware support, versioned endpoints, JWT authentication, and MySQL database.

---

## 📁 Project Structure

```
/my-api-project
├── config/             # DB config
├── core/               # Router, Auth, Middleware, etc.
├── modules/            # Versioned API modules (e.g., v1)
│   └── v1/
│       └── auth/
├── public/             # Public index + .htaccess
├── vendor/             # Composer dependencies
└── README.md
```

---

## ⚙️ Requirements

- PHP 7.4+ or 8.x
- Composer
- MySQL
- Apache (or run using PHP built-in server)

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/amaslic/php-starter-api.git
cd php-starter-api
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Database

Create a MySQL database and run this SQL:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

Update `config/config.php` with your DB credentials:

```php
return [
    'db_host' => 'localhost',
    'db_name' => 'your_db',
    'db_user' => 'your_user',
    'db_pass' => 'your_password'
];
```

---

### 4. Run the Server

#### Option A: PHP's built-in server (for development)

```bash
php -S localhost:8000 -t public
```

#### Option B: Apache with `.htaccess`

Make sure Apache is pointed to the `public/` directory and `.htaccess` is enabled.

---

## 🧪 API Endpoints

### 📄 Public Routes

| Method | Endpoint           | Description        |
|--------|--------------------|--------------------|
| POST   | `/api/v1/register` | Register a user    |
| POST   | `/api/v1/login`    | Login and get JWT  |

### 🔐 Protected Routes (require Bearer token)

| Method | Endpoint      | Description           |
|--------|---------------|-----------------------|
| GET    | `/api/v1/me`  | Get logged-in user ID |

> 🔐 Requires header: `Authorization: Bearer <your-token>`

---

## 🛡️ Features

- ✅ Modular folder structure
- ✅ Simple Router Class
- ✅ JWT-based authentication
- ✅ Versioned API (`/api/v1/...`)
- ✅ Middleware support for route protection
- ✅ CORS headers for frontend access
- ✅ Secure password hashing (`password_hash`)
- ✅ JSON responses

---

## 🔧 Next Steps

- Add role-based access control
- Add refresh token system
- Extend modules (`/user`, `/posts`, etc.)
- Add logging and request validation

---

## 🤝 License

MIT – Feel free to use and customize for personal or commercial projects.

---

## 🙌 Credits

Created with ❤️ by amaslic
