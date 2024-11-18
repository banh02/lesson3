<?php
// File index.php
require_once 'employeemanager.php';

// Khởi tạo EmployeeManager
$employeeManager = new EmployeeManager();

// Thêm nhân viên vào hệ thống
$employeeManager->addEmployee(new Employee('John', 'Doe', '1990-01-01', '123 Main St', 'Manager', 50000));
$employeeManager->addEmployee(new Employee('Jane', 'Smith', '1985-05-15', '456 Oak St', 'Developer', 40000));

// Hiển thị danh sách nhân viên
echo "Danh sách nhân viên:<br>";
$employeeManager->displayEmployeeList();

// Lưu danh sách nhân viên vào file JSON
$employeeManager->saveToFile('employees.json');

// Tải lại dữ liệu từ file JSON và hiển thị chi tiết
$employeeManager->loadFromFile('employees.json');
echo "<br>Chi tiết nhân viên John Doe:<br>";
$employeeManager->getEmployeeDetails('John', 'Doe');
?>