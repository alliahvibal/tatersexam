CREATE DATABASE IF NOT EXISTS taters;
USE taters;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    barangay_name VARCHAR(100) NOT NULL,
    municipality_name VARCHAR(100) NOT NULL,
    mobile_number VARCHAR(15) NOT NULL,
    age INT NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(32), 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
