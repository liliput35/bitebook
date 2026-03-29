# 🍽️ BiteBook: Catering Booking Management System

## 📌 Overview

**BiteBook** is a web-based catering booking management system developed using the Laravel framework. It enables caterers (admins) to efficiently manage their menu offerings, create bundled packages, and generate pricing, while allowing users to conveniently book catering reservations and receive final quotations.

The system is designed to streamline the catering workflow—from menu management to booking and price negotiation—into one centralized platform.

---

## 🎯 Objectives

* Simplify catering service reservations for users
* Provide caterers with full control over menu and pricing
* Enable dynamic pricing through bundles and adjustments
* Introduce a **negotiation-based workflow** between user and admin

---

## 👥 User Roles

### 👤 Admin (Caterer)

* Manage menu items (CRUD)
* Create and manage bundles/packages
* Adjust customer orders and pricing
* Approve and manage reservations

### 🙋 User (Customer)

* Browse menu and bundles
* Book catering reservations
* Receive final price quotations
* Review adjusted/negotiated orders

---

## ⚙️ Core Features

### 📋 1. Menu Management (CRUD)

Admins can fully manage menu items:

* **Create:** Add new dishes with details (name, description, price, image)
* **Read:** View all available menu items
* **Update:** Edit existing menu items
* **Delete:** Remove menu items from the system

---

### 📦 2. Bundle Management (CRUD)

Admins can group menu items into packages:

* **Create:** Build bundled packages (e.g., Party Package, Wedding Package)
* **Read:** View all bundles
* **Update:** Modify bundle contents and pricing
* **Delete:** Remove bundles

---

### 📅 3. Booking System

Users can create reservations by:

* Selecting menu items or bundles
* Specifying event details (date, number of guests, etc.)
* Submitting booking requests

---

### 💰 4. Pricing System

* Automatic price calculation based on selected items or bundles
* Flexible pricing (per pax or fixed bundle price)
* Final quotation generated for each booking

---

### 🔁 5. Unique Feature: Negotiation System

A key innovation of BiteBook is its **back-and-forth negotiation workflow**:

1. User submits a booking request
2. Admin receives full order details (items + quantities)
3. Admin can:

   * Adjust item quantities
   * Replace items
   * Convert order into a bundle for better pricing
4. System sends notification to user:

   > “Your order has been adjusted”
5. User reviews updated order and final price

This feature enhances flexibility and simulates real-world catering negotiations.

---

### 📊 6. Booking Management (Admin)

Admins can:

* View all reservations
* Update booking status (Pending, Approved, Completed)
* Modify booking details
* Send updated quotations

---

### 🔐 7. Authentication System

* Secure login and registration
* Role-based access (Admin & User)

---

## 🛠️ Tech Stack

* **Framework:** Laravel
* **Frontend:** Blade Templates (HTML, CSS, Bootstrap/Tailwind)
* **Database:** MySQL
* **Version Control:** GitHub

---

## 🚀 Future Enhancements

* Email notifications for booking updates
* PDF quotation generation
* Calendar view for reservations
* Payment integration

---

## 📌 Conclusion

BiteBook provides a complete solution for managing catering services, combining traditional booking systems with a unique negotiation feature that enhances user experience and business flexibility.

---


# 🚀 BiteBook Git Collaboration Workflow

This document outlines the Git workflow used for the development of **BiteBook: Catering Booking Management System**. The workflow ensures organized collaboration, clean version control, and efficient team integration.

---

## 💻 Cloning the Repository (Team Setup Guide) ONE TIME USE

Follow these steps to set up the BiteBook project on your local machine.

---

### 🔽 1. Clone the Repository

`git clone https://github.com/liliput35/bitebook.git`

### 📂 2. Navigate to the Project Folder

`cd bitebook`

### 🌿 3. Checkout the Develop Branch

⚠️ Always work on develop, NOT main

`git checkout develop`

If develop does not exist locally yet:

`git checkout -b develop origin/develop`

### 📦 4. Install Dependencies (Laravel & Tailwind)

`composer install`
`npm install`

### ⚙️ 5. Setup Environment File

`cp .env.example .env`

Then generate app key:

`php artisan key:generate`

### 🗄️ 6. Configure Database

Edit .env file and set your database:

`DB_DATABASE=bitebook`
`DB_USERNAME=root`
`DB_PASSWORD=`

### 🧱 7. Run Migrations

`php artisan migrate`

(Optional: seed sample data)

`php artisan db:seed`

### ▶️ 8. Run the Tailwind Compiler

`npm run dev`

### ▶️ 9. Run the Application

Open another terminal and run: 

`php artisan serve`

Open in browser:

http://127.0.0.1:8000

---

## 🌿 Branch Structure

- `main` → Production-ready / final demo system  
- `develop` → Integration branch for team features  
- `feature/*` → Individual feature development  

---

## 👥 Feature Branch Assignment

Each team member is assigned specific features:

- `feature/menu-crud` → Menu Management (Admin)  
- `feature/booking-system` → User Reservation System  
- `feature/bundle-system` → Package/Bundles  
- `feature/pricing-engine` → Pricing Computation  
- `feature/ui-dashboard` → User Interface  

---

## 🔄 Daily Workflow

### 1. Start from `develop`

`git checkout develop`
`git pull origin develop`


### 2. Create a Feature Branch

`git checkout -b feature/your-feature-name`

### 3. Work and Commit Changes 

`git add .`
`git commit -m "Add: short description of feature" `

* Add: New feature
* Fix: Bug fix
* Update: Improvements 

### 4. Push Feature Branch 

`git push origin feature/your-feature-name`

### 5. Create Pull Request (PR)

From: feature/your-feature-name
To: develop