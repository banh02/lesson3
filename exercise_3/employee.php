<?php
// File Employee.php
require_once 'person.php';

class Employee extends Person
{
    protected $jobPosition;
    protected $salary;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary)
    {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address);
        $this->jobPosition = $jobPosition;
        $this->salary = $salary;
    }

    // Getter and Setter for jobPosition
    public function getJobPosition()
    {
        return $this->jobPosition;
    }

    public function setJobPosition($jobPosition)
    {
        $this->jobPosition = $jobPosition;
    }

    // Getter for salary
    public function getSalary()
    {
        return $this->salary;
    }

    // Phương thức toArray để chuyển đổi đối tượng thành mảng
    public function toArray()
    {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'dateOfBirth' => $this->getDateOfBirth(),
            'address' => $this->getAddress(),
            'jobPosition' => $this->getJobPosition(),
            'salary' => $this->getSalary()
        ];
    }

    // Phương thức fromArray để khởi tạo đối tượng từ mảng
    public static function fromArray($data)
    {
        return new self(
            $data['firstName'],
            $data['lastName'],
            $data['dateOfBirth'],
            $data['address'],
            $data['jobPosition'],
            $data['salary']
        );
    }
}
?>