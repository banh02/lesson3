<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Diện Tích và Chu Vi Hình Chữ Nhật</title>
</head>

<body>
    <h2>Nhập thông tin hình chữ nhật</h2>
    <form method="post">
        <label for="chieuRong">Chiều rộng:</label>
        <input type="number" id="chieuRong" name="chieuRong" required><br><br>

        <label for="chieuCao">Chiều cao:</label>
        <input type="number" id="chieuCao" name="chieuCao" required><br><br>

        <input type="submit" value="Tính">
    </form>

    <?php
    class HinhChuNhat
    {
        public $chieuRong;
        public $chieuCao;

        public function __construct($chieuRong, $chieuCao)
        {
            $this->chieuRong = $chieuRong;
            $this->chieuCao = $chieuCao;
        }

        public function tinhDienTich()
        {
            return $this->chieuRong * $this->chieuCao;
        }

        public function tinhChuVi()
        {
            return 2 * ($this->chieuRong + $this->chieuCao);
        }

        public function hienThi()
        {
            return "Hình chữ nhật có chiều rộng = " . $this->chieuRong . " và chiều cao = " . $this->chieuCao;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $chieuRong = $_POST['chieuRong'];
        $chieuCao = $_POST['chieuCao'];

        if ($chieuRong <= 0 || $chieuCao <= 0) {
            echo "<p style='color: red;'>Vui lòng nhập chiều rộng và chiều cao là các số không âm.</p>";
        } else {
            $hinhChuNhat = new HinhChuNhat($chieuRong, $chieuCao);

            echo "<h2>Kết quả:</h2>";
            echo "<p>" . $hinhChuNhat->hienThi() . "</p>";
            echo "<p>Chu vi: " . $hinhChuNhat->tinhChuVi() . "</p>";
            echo "<p>Diện tích: " . $hinhChuNhat->tinhDienTich() . "</p>";
        }
    }
    ?>
</body>

</html>