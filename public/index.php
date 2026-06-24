<?php

// Nạp file khởi động hệ thống
require_once __DIR__ . '/../bootstrap.php';

use App\Core\Database;

try {
    // Gọi thử kết nối PDO từ Core ra xem có chạy được không
    $pdo = Database::pdo();
    
    echo "<h2 style='color: #2ecc71; text-align: center; margin-top: 50px;'>
            Chúc mừng Tài! Khung sườn MVC và kết nối Database (127.0.0.1) đã HOÀN THÀNH!
          </h2>";
} catch (\Exception $e) {
    echo "<h2 style='color: #e74c3c; text-align: center; margin-top: 50px;'>
            Lỗi rồi: " . $e->getMessage() . "
          </h2>";
}