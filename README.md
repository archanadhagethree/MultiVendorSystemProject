# 🛒 Multi Vendor System (Laravel)

A modular and scalable **Multi-Vendor E-commerce System** built using Laravel.  
This project simulates a real-world marketplace where customers can purchase products from multiple vendors, and the system automatically splits orders per vendor during checkout.

---

## 🚀 Features

### 👤 User Roles
- Admin
- Vendor
- Customer

### 🛍️ Customer Features
- Browse products from multiple vendors
- Add products to cart
- View cart grouped by vendor
- Checkout with automatic multi-vendor order split
- View order history

### 🏪 Vendor Features
- Manage products
- View vendor-specific orders
- Dashboard overview

### 🛠️ Admin Features
- View all orders
- Filter orders by Vendor, Customer, Status
- View detailed order breakdown

---

## 🧱 Tech Stack
- Laravel
- PHP
- MySQL
- Blade / Tailwind CSS
- Laravel Breeze

---

## ⚙️ Installation & Setup

```bash
# 1. Clone the repository
git clone https://github.com/archanadhagethree/MultiVendorSystemProject.git

# 2. Go into the project directory
cd MultiVendorSystemProject

# 3. Install PHP dependencies
composer install

# 4. Install Node.js dependencies
npm install

# 5. Build frontend assets
npm run dev

# 6. Copy .env.example to .env
cp .env.example .env   # On Windows PowerShell: copy .env.example .env

# 7. Generate application key
php artisan key:generate

# 8. Update .env for database
# Open .env and set the following:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=multiVendorSystem
# DB_USERNAME=root
# DB_PASSWORD=

# 9. Update mail settings in .env
# MAIL_MAILER=log
# MAIL_SCHEME=null
# MAIL_HOST=127.0.0.1
# MAIL_PORT=2525

# 10. Run migrations
php artisan migrate

# 11. Seed the database
php artisan db:seed

# 12. Create storage symlink
php artisan storage:link

# 13. Serve the application
php artisan serve
 ```



---

## 🔐 Sample Credentials

Admin:
- admin@example.com / password

Vendor:
- vendor1@example.com / vendor1@example
- vendor2@example.com / password

Customer:
- user@example.com / password

---

## 🧠 Architecture

### Design Patterns
- Service Layer Pattern
- Repository Pattern
- Event-Driven Architecture

### Components
Models:
- User, Vendor, Product
- Cart, CartItem
- Order, OrderItem
- Payment

Services:
- CartService
- CheckoutService

Repositories:
- ProductRepository
- OrderRepository

Events:
- OrderPlaced

Listener:
- LogOrderPlaced

---

## 🔄 Checkout Flow

1. Add products from multiple vendors
2. On checkout:
   - Validate stock
   - Group items by vendor
   - Create separate orders
   - Deduct stock
   - Create payments

---

## 📁 Folder Structure (Detailed)

# Project Folder Structure


```
multi-vendor-system/
├── app/
│   ├── Console/Commands/  
│   │   └── CancelUnpaidOrders.php
│   ├── Events/  
│   │   └── OrderPlaced.php
│   ├── Exceptions/  
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/  
│   │   │   │   └── OrderController.php
│   │   │   ├── Vendor/  
│   │   │   │   ├── ProductController.php  
│   │   │   │   └── OrderController.php
│   │   │   ├── CartController.php  
│   │   │   ├── CheckoutController.php  
│   │   │   ├── OrderController.php  
│   │   │   └── ProductController.php
│   │   ├── Middleware/  
│   │   │   ├── IsAdmin.php  
│   │   │   └── IsVendor.php
│   │   ├── Requests/  
│   │   │   └── AddToCartRequest.php
│   ├── Listeners/  
│   │   └── LogOrderPlaced.php
│   ├── Mail/  
│   │   └── OrderPlacedMail.php
│   ├── Models/  
│   │   ├── User.php  
│   │   ├── Vendor.php  
│   │   ├── Product.php  
│   │   ├── Cart.php  
│   │   ├── CartItem.php  
│   │   ├── Order.php  
│   │   ├── OrderItem.php  
│   │   └── Payment.php
│   ├── Policies/  
│   │   └── OrderPolicy.php
│   ├── Repositories/  
│   │   ├── Interfaces/  
│   │   │   ├── OrderRepositoryInterface.php  
│   │   │   └── ProductRepositoryInterface.php  
│   │   ├── ProductRepository.php  
│   │   └── OrderRepository.php
│   ├── Services/  
│   │   ├── CartService.php  
│   │   └── CheckoutService.php
│   └── Providers/
├── database/
│   ├── factories/  
│   ├── migrations/  
│   └── seeders/  
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── admin/  
│       ├── cart/  
│       ├── emails/  
│       ├── orders/  
│       ├── products/  
│       └── vendors/
├── routes/
├── storage/
└── README.md
```


---

## 🛡️ Security & Validation
- Form Requests validation
- Role-based access control
- Middleware & Policies

---

## ✨ Bonus Features
- Inventory protection
- Email notification (Log)
- Admin filters
- Vendor dashboard

---

## ⏰ Scheduled Order Cancellation (Cron Job)

* Cancels orders with status `pending`
* Older than 24 hours
* Updates status to `cancelled`

### 🛠️ Command

```bash
php artisan schedule:work
```
---

## 📌 Notes
- Orders split per vendor
- Payment simulated
- Scalable structure

---

## 🧑‍💻 Author
Archana Shrirang Dhage


