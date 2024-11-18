<?php
require_once 'classes.php';

$manager = new Manager('Nguyen', 'Hoa', '1985-10-10', 'Ha Noi', 'Manager', 3000);
$employee1 = new Employee('Tran', 'Van A', '1990-01-01', 'Da Nang', 'Developer', 1000);
$employee2 = new Employee('Le', 'Thi B', '1992-02-02', 'HCM City', 'Tester', 800);
$contractor = new Contractor('Phan', 'Van C', '1995-05-05', 'Hue', '6 months', 15);

$manager->addTeamMember($employee1);
$manager->addTeamMember($employee2);

$employeeManager = new EmployeeManager();
$employeeManager->addEmployee($manager);
$employeeManager->addEmployee($contractor);

echo "<pre>";
$employeeManager->displayEmployees();
echo "</pre>";
?>