<?php
/**
 * Dashboard Controller
 */
class DashboardController {
    /**
     * Hiển thị dashboard
     */
    public function index() {
        // Require authentication
        AuthMiddleware::requireAuth();
        
        $user = AuthMiddleware::getUser();
        
        include 'views/layouts/main.php';
        include 'views/dashboard/index.php';
    }
}
