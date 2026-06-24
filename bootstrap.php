<?php

// 1. Nạp Autoload của Composer để nhận diện các Namespace (App\)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// 2. Hàm tự chế để đọc file .env và nạp vào siêu biến toàn cục $_ENV
// (Vì chúng ta chưa cài thêm thư viện vlucas/phpdotenv nên viết hàm thuần này rất gọn và nhẹ)
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Bỏ qua các dòng comment dấu #
        if (strpos(trim($line), '#') === 0) continue;
        
        // Tách chuỗi theo dấu "=" đầu tiên
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

// 3. Nạp mảng cấu hình Database từ thư mục config
$dbConfig = require_once __DIR__ . '/config/database.php';

// 4. Khởi tạo kết nối Database dùng chung cho toàn bộ dự án
try {
    \App\Core\Database::init($dbConfig);
} catch (\Exception $e) {
    die("Khởi tạo hệ thống thất bại: " . $e->getMessage());
}