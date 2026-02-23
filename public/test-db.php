<?php
/**
 * Test Database Connection
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 Kiểm tra kết nối Database</h2><hr>";

try {
    // Kết nối database
    $host = 'localhost';
    $dbname = 'ap_app';
    $user = 'root';
    $pass = '';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ <strong>Kết nối Database thành công!</strong><br><br>";
    
    // Kiểm tra các bảng
    echo "<h3>📋 Các bảng trong database:</h3>";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "❌ Chưa có bảng nào! Bạn cần import file SQL.";
    } else {
        foreach ($tables as $table) {
            echo "✅ $table<br>";
        }
    }
    
    echo "<br><h3>👤 Kiểm tra users:</h3>";
    $users = $pdo->query("SELECT u.id, u.name, u.email, r.name as role FROM users u JOIN roles r ON u.role_id = r.id")->fetchAll();
    
    if (empty($users)) {
        echo "❌ Chưa có user nào!";
    } else {
        foreach ($users as $u) {
            echo "✅ {$u['name']} ({$u['email']}) - Role: {$u['role']}<br>";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ <strong>Lỗi kết nối Database:</strong><br>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
