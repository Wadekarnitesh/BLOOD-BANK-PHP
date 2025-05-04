-- Create database and tables
CREATE DATABASE IF NOT EXISTS blood_bank;
USE blood_bank;

-- Donors table
drop table if exists donors;
CREATE TABLE donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    location VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Receivers table
drop table if exists receivers;
CREATE TABLE receivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    location VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blood Requests table
drop table if exists blood_requests;
CREATE TABLE blood_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receiver_id INT NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    location VARCHAR(100) NOT NULL,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    FOREIGN KEY (receiver_id) REFERENCES receivers(id) ON DELETE CASCADE
);