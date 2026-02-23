<?php
/**
 * AP App - Entry Point
 * Public/index.php
 */

// Load config
require_once __DIR__ . '/../config/db.php';

// Load models
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';

// Load middleware
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

// Load router
require_once __DIR__ . '/../routes/router.php';

// Initialize router
$router = new Router();

// Define routes
$router->get('/', function() {
    header('Location: ' . APP_URL . '/login');
    exit;
});

$router->get('/login', ['AuthController', 'login']);
$router->post('/login/process', ['AuthController', 'handleLogin']);
$router->get('/logout', ['AuthController', 'logout']);

$router->get('/dashboard', ['DashboardController', 'index']);

// Dispatch request
$router->dispatch();
