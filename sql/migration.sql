-- =====================================================
-- AP App Migration - Create Tables & Seed Data
-- Run this file in phpMyAdmin
-- =====================================================

-- Create database
CREATE DATABASE IF NOT EXISTS ap_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ap_app;

-- =====================================================
-- ROLES TABLE
-- =====================================================
DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert roles
INSERT INTO roles (name, description) VALUES 
('admin', 'Quản trị viên - Full quyền'),
('manager', 'Quản lý - Quản lý dữ liệu'),
('viewer', 'Người xem - Chỉ được xem');

-- =====================================================
-- USERS TABLE
-- =====================================================
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user
-- Password: admin123 (đã hash bằng password_hash)
INSERT INTO users (name, email, password, role_id) VALUES 
('Admin User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- =====================================================
-- LOGIN ATTEMPTS TABLE (Optional - for security)
-- =====================================================
DROP TABLE IF EXISTS login_attempts;
CREATE TABLE login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_attempted_at (attempted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- SESSIONS TABLE (Optional - for session management)
-- =====================================================
DROP TABLE IF EXISTS user_sessions;
CREATE TABLE user_sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_expires (expires_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Verify data
-- =====================================================
SELECT 'Users table:' as '';
SELECT u.id, u.name, u.email, r.name as role 
FROM users u 
JOIN roles r ON u.role_id = r.id;

SELECT 'Roles table:' as '';
SELECT * FROM roles;
