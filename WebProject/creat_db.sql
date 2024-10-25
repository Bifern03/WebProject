-- สร้างฐานข้อมูล
CREATE DATABASE equipment_management;
USE equipment_management;

-- สร้างตารางบุคคลากร/สมาชิก (Personnel)
CREATE TABLE personnel (
    person_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'librarian', 'member') NOT NULL,
    contact_info VARCHAR(255)
);

-- สร้างตารางหมวดหมู่อุปกรณ์ (Categories)
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- สร้างตารางที่เก็บอุปกรณ์ (Location)
CREATE TABLE locations (
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- สร้างตารางสถานะอุปกรณ์ (Status)
CREATE TABLE status (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- สร้างตารางอุปกรณ์ (Equipment)
CREATE TABLE equipment (
    equipment_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category_id INT,
    location_id INT,
    status_id INT,
    barcode VARCHAR(100) UNIQUE,
    purchase_date DATE,
    price DECIMAL(10, 2),
    condition TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (location_id) REFERENCES locations(location_id),
    FOREIGN KEY (status_id) REFERENCES status(status_id)
);

-- สร้างตารางเก็บข้อมูลการยืม/คืนอุปกรณ์ (Borrow_Return)
CREATE TABLE borrow_return (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    equipment_id INT,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE,
    fine DECIMAL(10, 2) DEFAULT 0,
    FOREIGN KEY (member_id) REFERENCES personnel(person_id),
    FOREIGN KEY (equipment_id) REFERENCES equipment(equipment_id)
);

-- สร้างตารางกำหนดจำนวนวันให้ยืมอุปกรณ์ (Loan_Duration)
CREATE TABLE loan_duration (
    loan_duration_id INT AUTO_INCREMENT PRIMARY KEY,
    days INT NOT NULL
);

-- เพิ่มข้อมูลตัวอย่างลงในตารางสถานะอุปกรณ์ (Status)
INSERT INTO status (name) VALUES ('พร้อมใช้งาน'), ('อยู่ระหว่างการยืม'), ('เสียหาย');

-- เพิ่มข้อมูลตัวอย่างลงในตาราง Loan_Duration (กำหนดจำนวนวันให้ยืมอุปกรณ์เป็น 7 วัน)
INSERT INTO loan_duration (days) VALUES (7);