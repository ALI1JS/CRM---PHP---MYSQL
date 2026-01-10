<?php

$host = "mysql";
$username = "root";
$password = "password";
$database = "crm";


try {
  // Open Connection With Mysql
  $conn = new PDO("mysql:host=$host", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Execute Commmand : Create Database and use it (switch to new database )
  $conn->exec("CREATE DATABASE IF NOT EXISTS `$database`");
  $conn->exec("USE `$database`");

  $conn->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

  $conn->exec("
        CREATE TABLE IF NOT EXISTS customers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            phone VARCHAR(100),
            created_by INT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
        )
    ");


  $conn->exec("
        CREATE TABLE IF NOT EXISTS leads (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT,
            status ENUM('new','contacted','qualified','lost') DEFAULT 'new',
            assigned_to INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
            FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
        )
    ");

  $conn->exec("
        CREATE TABLE IF NOT EXISTS tickets (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT,
            title VARCHAR(255),
            description TEXT,
            status ENUM('open','in_progress','closed') DEFAULT 'open',
            priority ENUM('low','medium','high') DEFAULT 'medium',
            assigned_to INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
            FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
        )
    ");

  echo "CRM database setup completed successfully";


} catch (PDOException $e) {
  die("Database Connection Failed: " . $e->getMessage());
}

