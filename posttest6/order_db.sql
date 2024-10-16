CREATE DATABASE order_db;
USE order_db;

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    menu_item VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    note TEXT,
    file_name VARCHAR(255) NULL
);
