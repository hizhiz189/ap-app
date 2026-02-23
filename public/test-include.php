<?php
/**
 * Test all includes
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test includes</h2><hr>";

echo "1. Config... ";
require_once __DIR__ . '/../config/db.php';
echo "OK<br>";

echo "2. Database model... ";
require_once __DIR__ . '/../models/Database.php';
echo "OK<br>";

echo "3. User model... ";
require_once __DIR__ . '/../models/User.php';
echo "OK<br>";

echo "4. Role model... ";
require_once __DIR__ . '/../models/Role.php';
echo "OK<br>";

echo "5. AuthMiddleware... ";
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
echo "OK<br>";

echo "6. Router... ";
require_once __DIR__ . '/../routes/router.php';
echo "OK<br>";

echo "<hr><h2>All OK!</h2>";
