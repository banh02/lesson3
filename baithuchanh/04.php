<?php

// Định nghĩa lớp Shape
class Shape
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function show()
    {
        return "I am a shape. My name is $this->name";
    }
}

// Định nghĩa lớp Circle, kế thừa từ lớp Shape
class Circle extends Shape
{
    public $radius;

    public function __construct($name, $radius)
    {
        parent::__construct($name);
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        return pi() * pow($this->radius, 2);
    }

    public function calculatePerimeter()
    {
        return pi() * $this->radius * 2;
    }
}

// Định nghĩa lớp Cylinder, kế thừa từ lớp Circle
class Cylinder extends Circle
{
    public $height;

    public function __construct($name, $radius, $height)
    {
        parent::__construct($name, $radius);
        $this->height = $height;
    }

    public function calculateArea()
    {
        return parent::calculateArea() * 2 + parent::calculatePerimeter() * $this->height;
    }

    public function calculateVolume()
    {
        return parent::calculateArea() * $this->height;
    }
}

// Định nghĩa lớp Rectangle, kế thừa từ lớp Shape
class Rectangle extends Shape
{
    public $width;
    public $height;

    public function __construct($name, $width, $height)
    {
        parent::__construct($name);
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea()
    {
        return $this->height * $this->width;
    }

    public function calculatePerimeter()
    {
        return ($this->height + $this->width) * 2;
    }
}

// Định nghĩa lớp Square, kế thừa từ lớp Rectangle
class Square extends Rectangle
{
    public function __construct($name, $width)
    {
        parent::__construct($name, $width, $width);
    }
}

// Tạo các đối tượng, gọi các phương thức và quan sát kết quả

// Tạo một hình tròn, tính diện tích và chu vi của hình tròn đó
$circle = new Circle('Circle 01', 3);
echo 'Circle area: ' . $circle->calculateArea() . '<br />';
echo 'Circle perimeter: ' . $circle->calculatePerimeter() . '<br />';

// Tạo một hình trụ, tính diện tích, chu vi và thể tích của hình trụ đó
$cylinder = new Cylinder('Cylinder 01', 3, 4);
echo 'Cylinder area: ' . $cylinder->calculateArea() . '<br />';
echo 'Cylinder perimeter: ' . $cylinder->calculatePerimeter() . '<br />';
echo 'Cylinder volume: ' . $cylinder->calculateVolume() . '<br />';

// Tạo một hình chữ nhật, tính diện tích và chu vi của hình chữ nhật đó
$rectangle = new Rectangle('Rectangle 01', 3, 4);
echo 'Rectangle area: ' . $rectangle->calculateArea() . '<br />';
echo 'Rectangle perimeter: ' . $rectangle->calculatePerimeter() . '<br />';

// Tạo một hình vuông, tính diện tích và chu vi của hình vuông đó
$square = new Square('Square 01', 4);
echo 'Square area: ' . $square->calculateArea() . '<br />';
echo 'Square perimeter: ' . $square->calculatePerimeter() . '<br />';

?>