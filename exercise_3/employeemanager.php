<?php
// File EmployeeManager.php
require_once 'employee.php';

class EmployeeManager
{
    private $employees = [];

    // Thêm nhân viên vào danh sách
    public function addEmployee(Employee $employee)
    {
        $this->employees[] = $employee;
    }

    // Hiển thị danh sách nhân viên
    public function displayEmployeeList()
    {
        foreach ($this->employees as $employee) {
            echo $employee->getFirstName() . ' ' . $employee->getLastName() . ' - ' . $employee->getJobPosition() . '<br>';
        }
    }

    // Lấy chi tiết của một nhân viên theo tên
    public function getEmployeeDetails($firstName, $lastName)
    {
        foreach ($this->employees as $employee) {
            if ($employee->getFirstName() === $firstName && $employee->getLastName() === $lastName) {
                echo 'Name: ' . $employee->getFirstName() . ' ' . $employee->getLastName() . '<br>';
                echo 'Date of Birth: ' . $employee->getDateOfBirth() . '<br>';
                echo 'Address: ' . $employee->getAddress() . '<br>';
                echo 'Job Position: ' . $employee->getJobPosition() . '<br>';
                echo 'Salary: ' . $employee->getSalary() . '<br>';
                return;
            }
        }
        echo 'Employee not found.<br>';
    }

    // Lưu danh sách nhân viên vào file JSON
    public function saveToFile($filename)
    {
        $data = [];
        foreach ($this->employees as $employee) {
            $data[] = $employee->toArray();
        }
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Tải dữ liệu từ file JSON
    public function loadFromFile($filename)
    {
        if (file_exists($filename)) {
            $data = json_decode(file_get_contents($filename), true);
            foreach ($data as $employeeData) {
                $this->employees[] = Employee::fromArray($employeeData);
            }
        }
    }
}
?>