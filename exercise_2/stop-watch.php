<?php

// Tăng thời gian thực thi tối đa lên 300 giây (5 phút)
set_time_limit(300);  // Điều này sẽ giúp tránh lỗi vì vượt quá giới hạn thời gian

// Lớp StopWatch
class StopWatch
{
    private $startTime;
    private $endTime;

    // Phương thức khởi tạo không tham số khởi tạo startTime với thời gian hiện tại
    public function __construct()
    {
        $this->startTime = microtime(true); // Lấy thời gian hiện tại theo microseconds
    }

    // Getter cho startTime
    public function getStartTime()
    {
        return $this->startTime;
    }

    // Getter cho endTime
    public function getEndTime()
    {
        return $this->endTime;
    }

    // Phương thức start() để reset startTime về thời gian hiện tại
    public function start()
    {
        $this->startTime = microtime(true);
    }

    // Phương thức stop() để thiết đặt endTime về thời gian hiện tại
    public function stop()
    {
        $this->endTime = microtime(true);
    }

    // Phương thức getElapsedTime() trả về thời gian đã trôi qua theo số milisecond
    public function getElapsedTime()
    {
        return ($this->endTime - $this->startTime) * 1000; // Tính thời gian đã trôi qua theo milisecond
    }
}

// Hàm Quick Sort (Thuật toán sắp xếp nhanh)
function quickSort($arr)
{
    if (count($arr) < 2) {
        return $arr;
    }
    $left = $right = array();
    reset($arr);
    $pivot_key = key($arr);
    $pivot = array_shift($arr);
    foreach ($arr as $k => $v) {
        if ($v < $pivot)
            $left[$k] = $v;
        else
            $right[$k] = $v;
    }
    return array_merge(quickSort($left), array($pivot_key => $pivot), quickSort($right));
}

// Tạo mảng ngẫu nhiên 100,000 phần tử
$arr = [];
for ($i = 0; $i < 1000000; $i++) {
    $arr[] = rand(1, 10000000);
}

// Khởi tạo đối tượng StopWatch
$stopwatch = new StopWatch();

// Bắt đầu đo thời gian
$stopwatch->start();

// Gọi hàm Quick Sort
quickSort($arr);

// Dừng đo thời gian
$stopwatch->stop();

// Lấy thời gian thực thi
$executionTime = $stopwatch->getElapsedTime();

// Ghi kết quả vào tệp execution_time.txt
$file = fopen("execution_time.txt", "w");
if ($file) {
    fwrite($file, "Thời gian thực thi thuật toán Quick Sort cho 100,000 số: " . $executionTime . " ms\n");
    fclose($file);
    echo "Kết quả đã được ghi vào tệp execution_time.txt\n";
} else {
    echo "Không thể mở tệp để ghi dữ liệu.\n";
}

?>