# QR Code Inventory Management System

## Overview
The system allows users to manage an inventory of vehicles and retrieve their details via QR codes. This project uses **Laravel** for the backend and **React Native** for the mobile app.

## Features

### Web Application
- **Add new vehicle data** (Create).
- **Edit existing vehicle data** (Update).
- **Remove vehicle data** (Delete).
- **Generate QR codes** for each vehicle.
- **User Authentication**:
  - **Login**: Users can log in with their email and password.
  - **Registration**: New users can sign up by providing their name, email, and password.
  - **Logout**: Users can log out to end their session.

### React Native Mobile Application
- **QR Code Scanner**: Users can scan QR codes to fetch vehicle data.
- **Display Vehicle Data**: Display the vehicle details in a user-friendly format.

## Database Schema
The following fields are used to store vehicle details:
- **ID**: Primary Key
- **Brand**: String
- **Model**: String
- **Variant**: String
- **Manufacture Year**: Integer
- **Transmission**: String

## How to Use the Web Application

### Authentication
- **Register**: Navigate to `/register` to create a new account by providing a valid email, password, and name.
- **Login**: Navigate to `/login` to log in with your registered email and password. You can use the "Remember Me" checkbox to stay logged in.
- **Logout**: Once logged in, click the logout button to end your session.

### Vehicle Management
- **Add Vehicle**: Use the form to add a new vehicle to the inventory.
- **Edit Vehicle**: Edit and update an existing vehicle's details.
- **Delete Vehicle**: Remove a vehicle from the system.

### QR Code Generation
- Every vehicle entry will automatically generate a QR code that can be used to retrieve its details.
- QR Codes are stored in \public\qrcodes

## Setup Instructions

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js and npm
- Laravel >= 11.31
- React Native environment set up

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/vehicle-qrcode-inv-management.git
    cd qr-code-inventory
    ```

2. Install PHP dependencies:
    ```bash
    composer install
    composer require endroid/qr-code
    ```

3. Install JavaScript dependencies:
    ```bash
    npm install
    
    ```

4. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```

5. Generate the application key:
    ```bash
    php artisan key:generate
    ```

6. Set up the database (use SQLite or configure a different DB):
    - Ensure `database/database.sqlite` exists or change `.env` to use MySQL/PostgreSQL if needed.

7. Run database migrations:
    ```bash
    php artisan migrate
    ```

8. Serve the application:
    ```bash
    php artisan serve
    ```

## Frameworks and Libraries Used
- **Laravel** for the backend.
- **React Native** for the mobile app.
- **Blade**: Laravel's templating engine for dynamic frontend rendering.
- **Bootstrap** and **CSS** for frontend styling.
- **Endroid QR Code** for QR code generation.
- **Laravel UI** for authentication scaffolding.

