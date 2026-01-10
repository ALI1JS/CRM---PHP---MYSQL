
# CRM Project

## What is it?

A Simple Customer Relationship Management (CRM) system built with PHP.

## Features Detail

- **Authentication**
    - Login
    - Logout

- **Customer Management** 
   - Add New Customer 
   - Update Custmer
   - Search for customer 
   - Delete customer
   - List all Customers

- **Ticket Management** 
   - Add new Ticket For Spesfic Customer 
   - Update Ticket
   - Delete Ticket
   - Get Ticket Details
   - List All Ticket

## Technology

- PHP
- MYSQL
- HTML - CSS
- Apatch Server

## Installation & Setup

### Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server

### Steps

1. **Clone the repository**
    ```bash
    git clone <repository-url>
    cd crm
    ```

2. **Setup database**
    ```bash
    mysql -u root -p < database.sql
    ```

3. **Configure database connection**
    - Edit `db.php`
    - Update your database credentials

4. **Run locally**
    ```bash
    php -S localhost:8000
    ```

5. **Access the application**
    - Open your browser and go to `http://localhost:8000`


    ## Project Structure

    ```
    crm/
    ├── public/
    ├── views/
    ├── controller/
    ├── routes/
    └── db.php
    └── setup.php
    └── hash.php
    ```

    The project uses Object-Oriented Programming (OOP) principles throughout the codebase.
