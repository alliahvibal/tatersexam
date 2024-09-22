USE taters;

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barangay_name VARCHAR(100) NOT NULL,
    municipality_name VARCHAR(100) NOT NULL
);