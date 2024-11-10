# getUp Assignment

## Overview

This project is a simple application built with Laravel 10, Breeze, and a RESTful API. The application focuses on key features such as product management, user authentication, role-based access control (RBAC), email notifications with a database job queue, and efficient query optimizations.

---

## Features

- **Product Management**
- **User Authentication**
- **Role-Based Access Control (RBAC)**
- **Email Notifications via Queue**
- **Database Query Optimization**

---

## 1. Approach and Challenges Encountered

### 1.1 Approach for Building the API with Authentication

The goal was to build a simple RESTful API for an e-commerce application, focusing on product management and user authentication.

**Authentication:**  
We used **Laravel Sanctum** for token-based authentication. Sanctum was chosen due to its simplicity and ease of integration into small-to-medium-sized applications.

**Challenges:**
- Managing token expiration and renewal can be tricky with Sanctum, as it uses short-lived tokens. Initially, I attempted to use **Laravel Passport**, but it does not work with PHP 8 and higher, and since Laravel 10 is recommended for PHP 8 or higher, we chose Sanctum instead.

---

## 2. Database Optimization & Query Challenge

### 2.1 Approach for Database Optimization & Query Challenge

To handle large datasets, the goal was to optimize queries for retrieving the top 5 best-selling products and most recent orders.

**Optimizations Applied:**
- **Indexes:** Added indexes on the columns frequently queried: `customer_id`, `product_id`, `created_at` in the `orders` table.
- This helped to speed up retrieval of products and orders, especially when working with large datasets.

---

## 3. Role-Based Access Control (RBAC)

### 3.1 Approach for Role-Based Access Control (RBAC)

The RBAC system required the creation of two roles: **Admin** and **Editor**.

- **Admin:** Full access to manage all content.
- **Editor:** Limited access to update only specific resources (e.g., products).

**Steps:**
1. Defined roles in the database using a `roles` table.
2. Created a `ProductPolicy` to handle authorization logic for viewing, creating, updating, and deleting products.

---

## 4. Queue for Email Notifications

### 4.1 Approach for Queue for Email Notifications

The task required setting up a queued job to send a welcome email to the user after registration.

**Steps:**
1. Installed and configured the queue system.
2. Created a `SendWelcomeEmail` job that sends a welcome email to the newly registered user.
3. Used job dispatching (`dispatch()`) to push the email job into the queue.
4. Ensured the queue was processed using Laravel's `queue:work` command.

**Challenges:**
- After registration, the email needs to be validated to ensure correctness. However, since the email is sent asynchronously via the queue, if the email is invalid, the queue job will throw an exception and fail to send the email.

---

## 5. Optimized Complex Query with Eloquent

### 5.1 Approach for Optimized Complex Query with Eloquent

The task required writing an optimized query to retrieve orders with their associated products, grouped by product category.

**Steps:**
1. Used **eager loading** (`with()`) to prevent the N+1 query problem.
2. Grouped the results by `category_id` to optimize the organization of data.

**Challenges:**
- The application involves two tables: `products` and `orders`. An order can contain multiple products, so a pivot table is needed to map the relationship between orders and products.
- Storing multiple `product_ids` as an array in the orders table is not optimal and leads to inefficient queries when fetching data.

---