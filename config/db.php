<?php
/**
 * Database Configuration
 * Copy file này thành config.php và điền thông tin DB của bạn
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'ap_app');
define('DB_USER', 'root');
define('DB_PASS', '');

// App Config
define('APP_NAME', 'AP App');
define('APP_URL', 'http://localhost:8080/ap-app/public');

// Session config
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_start();

// Timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
