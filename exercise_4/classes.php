<?php
// Lớp Person
class Person
{
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $address;

    public function __construct($firstName, $lastName, $dateOfBirth, $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->address = $address;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function getAddress()
    {
        return $this->address;
    }

    public function toArray()
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'dateOfBirth' => $this->dateOfBirth,
            'address' => $this->address
        ];
    }
}

// Lớp Employee kế thừa từ Person
class Employee extends Person
{
    private $jobPosition;
    protected $salary;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary)
    {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address);
        $this->jobPosition = $jobPosition;
        $this->salary = $salary;
    }

    public function getJobPosition()
    {
        return $this->jobPosition;
    }
    public function getSalary()
    {
        return $this->salary;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'jobPosition' => $this->jobPosition,
            'salary' => $this->salary
        ]);
    }
}

// Lớp Manager kế thừa từ Employee
class Manager extends Employee
{
    private $team;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary)
    {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address, $jobPosition, $salary);
        $this->team = [];
    }

    public function addTeamMember($employee)
    {
        $this->team[] = $employee;
    }

    public function removeTeamMember($employeeName)
    {
        foreach ($this->team as $index => $member) {
            if ($member->getFirstName() . " " . $member->getLastName() == $employeeName) {
                unset($this->team[$index]);
                break;
            }
        }
        $this->team = array_values($this->team); // Reset index
    }

    public function displayTeam()
    {
        echo "Team Members for {$this->getFirstName()} {$this->getLastName()}:\n";
        foreach ($this->team as $member) {
            echo "- " . $member->getFirstName() . " " . $member->getLastName() . "\n";
        }
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'team' => array_map(function ($member) {
                return $member->toArray();
            }, $this->team)
        ]);
    }
}

// Lớp Contractor kế thừa từ Person
class Contractor extends Person
{
    private $contractPeriod;
    private $hourlyRate;

    public function __construct($firstName, $lastName, $dateOfBirth, $address, $contractPeriod, $hourlyRate)
    {
        parent::__construct($firstName, $lastName, $dateOfBirth, $address);
        $this->contractPeriod = $contractPeriod;
        $this->hourlyRate = $hourlyRate;
    }

    public function getContractPeriod()
    {
        return $this->contractPeriod;
    }
    public function getHourlyRate()
    {
        return $this->hourlyRate;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'contractPeriod' => $this->contractPeriod,
            'hourlyRate' => $this->hourlyRate
        ]);
    }
}

// Lớp EmployeeManager
class EmployeeManager
{
    private $employees;
    private $file;

    public function __construct($file = 'employees.json')
    {
        $this->file = $file;
        $this->employees = $this->loadFromFile();
    }

    public function addEmployee($employee)
    {
        $this->employees[] = $employee;
        $this->saveToFile();
    }

    public function displayEmployees()
    {
        foreach ($this->employees as $employee) {
            if ($employee instanceof Manager) {
                // Hiển thị thông tin Manager
                echo $employee->getFirstName() . ", " .
                    $employee->getLastName() . ", " .
                    $employee->getDateOfBirth() . ", " .
                    $employee->getAddress() . ", " .
                    $employee->getJobPosition() . ", " .
                    $employee->getSalary() . ", Team: [";

                foreach ($employee->toArray()['team'] as $teamMember) {
                    echo $teamMember['firstName'] . " " . $teamMember['lastName'] . ", ";
                }
                echo "]<br>";
            } elseif ($employee instanceof Contractor) {
                // Hiển thị thông tin Contractor
                echo $employee->getFirstName() . ", " .
                    $employee->getLastName() . ", " .
                    $employee->getDateOfBirth() . ", " .
                    $employee->getAddress() . ", " .
                    $employee->getContractPeriod() . ", " .
                    $employee->getHourlyRate() . "<br>";
            } elseif ($employee instanceof Employee) {
                // Hiển thị thông tin Employee
                echo $employee->getFirstName() . ", " .
                    $employee->getLastName() . ", " .
                    $employee->getDateOfBirth() . ", " .
                    $employee->getAddress() . ", " .
                    $employee->getJobPosition() . ", " .
                    $employee->getSalary() . "<br>";
            }
        }
    }


    private function saveToFile()
    {
        $data = array_map(function ($employee) {
            return $employee->toArray();
        }, $this->employees);
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function loadFromFile()
    {
        if (file_exists($this->file)) {
            $data = json_decode(file_get_contents($this->file), true);
            $employees = [];
            foreach ($data as $item) {
                if (isset($item['team'])) {
                    $manager = new Manager(
                        $item['firstName'],
                        $item['lastName'],
                        $item['dateOfBirth'],
                        $item['address'],
                        $item['jobPosition'],
                        $item['salary']
                    );
                    foreach ($item['team'] as $teamMember) {
                        $manager->addTeamMember(new Employee(
                            $teamMember['firstName'],
                            $teamMember['lastName'],
                            $teamMember['dateOfBirth'],
                            $teamMember['address'],
                            $teamMember['jobPosition'],
                            $teamMember['salary']
                        ));
                    }
                    $employees[] = $manager;
                } elseif (isset($item['contractPeriod'])) {
                    $employees[] = new Contractor(
                        $item['firstName'],
                        $item['lastName'],
                        $item['dateOfBirth'],
                        $item['address'],
                        $item['contractPeriod'],
                        $item['hourlyRate']
                    );
                } else {
                    $employees[] = new Employee(
                        $item['firstName'],
                        $item['lastName'],
                        $item['dateOfBirth'],
                        $item['address'],
                        $item['jobPosition'],
                        $item['salary']
                    );
                }
            }
            return $employees;
        }
        return [];
    }
}

?>