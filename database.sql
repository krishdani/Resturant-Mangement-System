CREATE DATABASE gritandglow;

    USE gritandglow;

    CREATE TABLE products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        price DECIMAL(10,2),
        image VARCHAR(255)
    );

    CREATE TABLE cart (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT,
        quantity INT DEFAULT 1,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    );

    CREATE TABLE orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(255),
        user_email VARCHAR(255),
        total_price DECIMAL(10,2),
        payment_method VARCHAR(50),
        status ENUM('Pending', 'Completed') DEFAULT 'Pending'
    );