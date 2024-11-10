# getUp Assignment

This is a Laravel-based web application for managing products, users, orders, and roles. It includes role-based access control and queued jobs for email sending.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Cloning the Repository](#cloning-the-repository)
3. [Setting Up the Environment](#setting-up-the-environment)
4. [Running the Application](#running-the-application)
5. [Testing the Application](#testing-the-application)

---

## 1. Prerequisites

Before running the project, make sure you have the following software installed on your machine:

- **PHP** (version 8.0 or higher)
- **Composer** (to install PHP dependencies)
- **Node.js** and **npm** (to install JavaScript dependencies)
- **MySQL** (or any compatible database)
- **Git** (to clone the repository)

---

## 2. Cloning the Repository

First, clone the repository to your local machine using the following Git command:

```bash
git clone https://github.com/Fahadhoq/getUpAssignment.git
cd getUpAssignment 
```



## 3. Setting Up the Environment

### A) Copy the `.env.example` to `.env`

Laravel requires an environment file (`.env`) to store sensitive configuration like database credentials and API keys. To create the `.env` file, run the following command:

```bash
cp .env.example .env
```

### B) Configure Database Connection

Open the `.env` file in your project root and update the following values to match your local database configuration:

```bash
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=fahadulhoq.bitspeck@gmail.com
MAIL_PASSWORD=incxmkhijlhfnebl
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=fahadulhoq.bitspeck@gmail.com
MAIL_FROM_NAME="getUpAssignment"
```


### C) Generate the Laravel Application Key

The application key is required for encryption. Run this command to generate it:

```bash
php artisan key:generate
```

### D) Install PHP Dependencies

Run Composer to install the required PHP dependencies:

```bash
composer install
```

### E) Install JavaScript Dependencies

The project includes front-end assets (e.g., Blade views) that need to be compiled. Install the required JavaScript dependencies by running the following command:

```bash
npm install
```

## 4. Running the Application

### A) Run the Database Migrations

To set up the database schema (create the necessary tables), run the following command:

```bash
php artisan migrate
```

### B) Seed the Database

Seed the database with sample data for roles, users, customers, categories, products, and orders by running:

```bash
php artisan db:seed
```

### C) Start the Laravel Development Server

To start the Laravel development server, run the following command:

```bash
php artisan serve
```

Compile the assets using:
```bash
npm run dev
```

Run the queue worker:
```bash
php artisan queue:work
```

## 5. Testing the Application

### A) Testing Authentication

1. Go to [http://localhost:8000/register](http://localhost:8000/register) to register a new user.
   - After registration, a welcome email will be sent via a queued job if the email is valid.
2. After registration, go to [http://localhost:8000/login](http://localhost:8000/login) to log in with the new user credentials.

### B) Testing Role-Based Access

- **As an Admin**, you should be able to:
  - View, create, update, and delete products at `/product/list`.
  - Manage roles at `/role`.
  - Manage users at `/users`.
  - View customer and order lists at `/customer/list` and `/order/list`.
  
- **As an Editor**, you should only be able to update certain content, like products. Editors should have restricted access to other areas such as role management, customer list, and order list.

- If you're testing role-based permissions, ensure that the roles have been assigned to users, either using the admin interface. Example admin credentials:
  - **Email**: `admin@getupAssignment.com`
  - **Password**: `12345678`

### C) Operations for Roles

- View all roles at the "Show All Roles" section.
- Assign roles to users under the "Assign Roles" section.

### D) Operations for Users

- View all users at the "Show All Users" section.

### E) Operations for Products

- View all products in the "Show All Products" section. Here, you can:
  - View, update, and delete existing products.
  - Click on "Create Product" to add a new product.

### F) Operations for Customers and Orders

- View the customer list in the "Show All Customers" section.
- View the order list in the "Show All Orders" section. You can see orders with the details of each product, grouped by product category.

### G) Operations for Dashboard

- View the top 5 best-selling products.
- View the most recent customer orders.



