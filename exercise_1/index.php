<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải Phương Trình Bậc Hai</title>
</head>

<body>
    <h2>Giải Phương Trình Bậc Hai: ax² + bx + c = 0</h2>

    <form method="POST">
        <label for="a">Nhập hệ số a:</label>
        <input type="number" id="a" name="a" required><br><br>

        <label for="b">Nhập hệ số b:</label>
        <input type="number" id="b" name="b" required><br><br>

        <label for="c">Nhập hệ số c:</label>
        <input type="number" id="c" name="c" required><br><br>

        <button type="submit">Giải Phương Trình</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = (int) $_POST['a'];
        $b = (int) $_POST['b'];
        $c = (int) $_POST['c'];

        class QuadraticEquation
        {
            private $a;
            private $b;
            private $c;

            public function __construct($a, $b, $c)
            {
                $this->a = $a;
                $this->b = $b;
                $this->c = $c;
            }

            public function getDiscriminant()
            {
                return pow($this->b, 2) - 4 * $this->a * $this->c;
            }

            public function getRoot1()
            {
                $delta = $this->getDiscriminant();
                if ($delta >= 0) {
                    return (-$this->b + sqrt($delta)) / (2 * $this->a);
                } else {
                    return null;
                }
            }

            public function getRoot2()
            {
                $delta = $this->getDiscriminant();
                if ($delta >= 0) {
                    return (-$this->b - sqrt($delta)) / (2 * $this->a);
                } else {
                    return null;
                }
            }
        }

        $equation = new QuadraticEquation($a, $b, $c);
        $delta = $equation->getDiscriminant();

        echo "<h3>Kết quả:</h3>";
        if ($delta > 0) {
            $root1 = $equation->getRoot1();
            $root2 = $equation->getRoot2();
            echo "Phương trình có hai nghiệm phân biệt: x1 = $root1 và x2 = $root2";
        } elseif ($delta == 0) {
            $root1 = $equation->getRoot1();
            echo "Phương trình có nghiệm kép: x1 = x2 = $root1";
        } else {
            echo "Phương trình không có nghiệm thực";
        }
    }
    ?>
</body>

</html>