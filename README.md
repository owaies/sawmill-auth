# Sawmill Auth

A simple PHP-based user authentication system using MongoDB as the database.

## 📁 Project Structure

```
sawmill-auth/
├── vendor/               # Composer dependencies
├── db.php                # MongoDB connection
├── signup.php            # Signup logic
├── login.php             # Login logic
├── index.html            # Login/Signup form UI
├── style.css             # CSS styling
├── script.js             # Toggle script
├── composer.json         # Composer config
```

---

## ✅ Requirements

- [XAMPP](https://www.apachefriends.org/index.html) (or any Apache + PHP setup)
- [Composer](https://getcomposer.org/) (PHP dependency manager)
- PHP ≥ 8.2
- MongoDB extension for PHP
- A MongoDB server (Local or Cloud like Atlas)

---

## ⚙️ Setup Instructions

### 1. ✅ Install MongoDB PHP Driver

```bash
# Use PECL to install MongoDB PHP driver
pecl install mongodb

# Then enable it by adding this line to your php.ini
extension=mongodb
```

> 📍 Find `php.ini` from XAMPP: `C:\xampp\php\php.ini`

### 2. ✅ Install Composer Dependencies

Navigate to your project directory:

```bash
cd C:\xampp\htdocs\sawmill-auth
composer require mongodb/mongodb
```

> This generates the `vendor/` directory with `autoload.php`.

---

## 🔗 MongoDB Connection (db.php)

Ensure your `db.php` connects like this:

```php
<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->sawmill_auth->users;
?>
```

---

## 🚀 Run Project

1. Open **XAMPP** and start **Apache**.
2. Place `sawmill-auth/` folder in `C:\xampp\htdocs\`
3. Visit:
```
http://localhost/sawmill-auth/index.html
```

---

## 🧪 Test Auth

- Signup with a new account → stored in MongoDB
- Login → if credentials match, user sees a welcome page.

---

## 🗂 GitHub Setup (optional)

If pushing to GitHub:

```bash
git init
git remote add origin https://github.com/YOUR_USERNAME/sawmill-auth.git
git add .
git commit -m "Initial commit"
git branch -M main
git push -u origin main
```

If you face user identity issues:

```bash
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

---

## 🛠️ Troubleshooting

- **Apache won’t start**: Port might be in use. Change Apache port or stop other services (like IIS/Skype).
- **MongoDB errors**: Make sure MongoDB server is running and `extension=mongodb` is in `php.ini`.

---

## 📄 License

MIT – Use freely for educational and commercial purposes.
