CREATE DATABASE herald_db;

USE herald_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Dummy data

INSERT INTO students (student_id, full_name, password_hash) VALUES
('np0023', 'Ram Prasad', '$2y$10$Something'),
('np5678', 'Sita Kumari', '$2y$10$pass');

