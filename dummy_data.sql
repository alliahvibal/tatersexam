USE taters;

INSERT INTO users (username, password, lastname, firstname, address, barangay_name, municipality_name, mobile_number, age, gender, email) 
VALUES
-- Palanan, Makati
('john123', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Doe', 'John', '123 Main St', 'Palanan', 'Makati', '09170000001', 25, 'M', 'john@example.com'),
('alice456', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Blue', 'Alice', '357 Ash St', 'Palanan', 'Makati', '09170000010', 23, 'F', 'alice@example.com'),
('sarah789', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'White', 'Sarah', '214 Cedar St', 'Palanan', 'Makati', '09170000011', 26, 'F', 'sarah@example.com'),

-- San Antonio, Makati
('jane101', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Smith', 'Jane', '456 Oak St', 'San Antonio', 'Makati', '09170000002', 30, 'F', 'jane@example.com'),
('ron202', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Grey', 'Ron', '129 Pine St', 'San Antonio', 'Makati', '09170000012', 33, 'M', 'ron@example.com'),
('carla303', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Brown', 'Carla', '789 Oak St', 'San Antonio', 'Makati', '09170000013', 27, 'F', 'carla@example.com'),

-- Poblacion, Makati
('mike404', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Jones', 'Mike', '789 Pine St', 'Poblacion', 'Makati', '09170000003', 22, 'M', 'mike@example.com'),
('nina505', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Black', 'Nina', '654 Walnut St', 'Poblacion', 'Makati', '09170000014', 30, 'F', 'nina@example.com'),
('tony606', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Green', 'Tony', '258 Birch St', 'Poblacion', 'Makati', '09170000015', 28, 'M', 'tony@example.com'),

-- Commonwealth, Quezon City
('lisa707', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Brown', 'Lisa', '321 Elm St', 'Commonwealth', 'Quezon City', '09170000004', 28, 'F', 'lisa@example.com'),
('jessica808', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'White', 'Jessica', '123 Pine St', 'Commonwealth', 'Quezon City', '09170000016', 29, 'F', 'jessica@example.com'),
('henry909', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Grey', 'Henry', '456 Maple St', 'Commonwealth', 'Quezon City', '09170000017', 31, 'M', 'henry@example.com'),

-- Holy Spirit, Quezon City
('mark1010', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'White', 'Mark', '654 Maple St', 'Holy Spirit', 'Quezon City', '09170000005', 35, 'M', 'mark@example.com'),
('diana1111', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Smith', 'Diana', '987 Oak St', 'Holy Spirit', 'Quezon City', '09170000018', 28, 'F', 'diana@example.com'),
('leo1212', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Brown', 'Leo', '321 Cedar St', 'Holy Spirit', 'Quezon City', '09170000019', 34, 'M', 'leo@example.com'),

-- Tandang Sora, Quezon City
('susan1313', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Black', 'Susan', '987 Cedar St', 'Tandang Sora', 'Quezon City', '09170000006', 40, 'F', 'susan@example.com'),
('olivia1414', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Red', 'Olivia', '951 Birch St', 'Tandang Sora', 'Quezon City', '09170000020', 35, 'F', 'olivia@example.com'),
('john1515', '$2y$10$33X3Ghy0mrL5hWg2DPe.7eBJomgA7Nm/5KhASj9YdG', 'Grey', 'John', '654 Maple St', 'Tandang Sora', 'Quezon City', '09170000021', 38, 'M', 'john.grey@example.com');
