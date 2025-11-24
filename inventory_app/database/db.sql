-- Database dump for aplikasi inventaris
CREATE DATABASE IF NOT EXISTS inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventory_db;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(191) NOT NULL,
  email VARCHAR(191) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','super_admin') NOT NULL DEFAULT 'admin',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(50) NOT NULL,
  name VARCHAR(191) NOT NULL,
  stock INT NOT NULL DEFAULT 0
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  item_id INT NOT NULL,
  user_id INT NOT NULL,
  type ENUM('borrow','return') NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  returned_at DATETIME DEFAULT NULL,
  FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Seed default super admin
INSERT INTO users (name,email,password,role) VALUES
('Super Admin','super@domain.test', '$2b$12$cSaEaNUX9RUaJpDDAyQWJ.7FlZdxZGNuayWXBQ2CHViAwr9xGhKyq', 'super_admin');

-- Example items
INSERT INTO items (code,name,stock) VALUES
('BRG-001','Proyektor',2),
('BRG-002','Laptop',5),
('BRG-003','Kabel HDMI',10);
