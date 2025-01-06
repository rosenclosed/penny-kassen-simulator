-- Migration: Create POS Schema

-- Categories Table
CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Discounts Table
CREATE TABLE Discounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    percentage DECIMAL(5,2) NOT NULL,
    valid_from DATE NOT NULL,
    valid_to DATE NOT NULL,
    type ENUM('product', 'employee_card', 'penny_app') DEFAULT 'product'
);

-- Products Table
CREATE TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT,
    ean_13 CHAR(13),
    ean_8 CHAR(8),
    nan VARCHAR(50),
    plu VARCHAR(50),
    price DECIMAL(10,2) NOT NULL,
    weighed BOOLEAN DEFAULT FALSE,
    pfand DECIMAL(10,2),
    crate BOOLEAN DEFAULT FALSE,
    age_restriction ENUM('12', '16', '18'),
    vat_rate ENUM('0', '7', '19') NOT NULL,
    discount_id INT,
    FOREIGN KEY (category_id) REFERENCES Categories(id),
    FOREIGN KEY (discount_id) REFERENCES Discounts(id)
);

-- Product Attributes Table
CREATE TABLE Product_Attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    `key` VARCHAR(255) NOT NULL,
    `value` TEXT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES Products(id)
);

-- EmployeeCards Table
CREATE TABLE EmployeeCards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    card_number VARCHAR(50) NOT NULL UNIQUE,
    discount_id INT NOT NULL,
    owner_name VARCHAR(255),
    FOREIGN KEY (discount_id) REFERENCES Discounts(id)
);

-- PennyApp Table
CREATE TABLE PennyApp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    app_id VARCHAR(50) NOT NULL UNIQUE,
    discount_id INT NOT NULL,
    activation_date DATE NOT NULL,
    FOREIGN KEY (discount_id) REFERENCES Discounts(id)
);
