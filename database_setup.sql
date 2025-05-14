-- Create the database
CREATE DATABASE IF NOT EXISTS canteen_management;
USE canteen_management;

-- Create admin table
CREATE TABLE IF NOT EXISTS tbl_admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create category table
CREATE TABLE IF NOT EXISTS tbl_category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    Image_name VARCHAR(255),
    featured VARCHAR(10) DEFAULT 'No',
    active VARCHAR(10) DEFAULT 'Yes'
);

-- Create food table
CREATE TABLE IF NOT EXISTS tbl_food (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_name VARCHAR(255),
    category_id INT,
    featured VARCHAR(10) DEFAULT 'No',
    active VARCHAR(10) DEFAULT 'Yes',
    FOREIGN KEY (category_id) REFERENCES tbl_category(id)
);

-- Create order table
CREATE TABLE IF NOT EXISTS tbl_order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    food VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    order_date DATETIME NOT NULL,
    status VARCHAR(50) NOT NULL,
    customer_name VARCHAR(150) NOT NULL,
    customer_contact VARCHAR(20) NOT NULL,
    customer_email VARCHAR(150) NOT NULL
);

-- Insert default admin user (username: admin, password: admin123)
INSERT INTO tbl_admin (full_name, username, password) 
VALUES ('Administrator', 'admin', MD5('admin123'));

-- Trigger: Prevent deleting a category with assigned foods
DELIMITER $$
CREATE TRIGGER before_category_delete
BEFORE DELETE ON tbl_category
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM tbl_food WHERE category_id = OLD.id) > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot delete category with assigned foods.';
    END IF;
END $$
DELIMITER ;

-- Procedure: Get daily sales summary
DELIMITER $$
CREATE PROCEDURE get_daily_sales(IN sales_date DATE)
BEGIN
    SELECT COUNT(*) AS total_orders, SUM(total) AS total_revenue
    FROM tbl_order
    WHERE DATE(order_date) = sales_date;
END $$
DELIMITER ;
