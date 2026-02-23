<?php
/**
 * Authentication Middleware
 * Chặn truy cập theo quyền (route guard)
 */
class AuthMiddleware {
    /**
     * Kiểm tra đã đăng nhập chưa
     */
    public static function requireAuth() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/login');
            exit;
        }
    }

    /**
     * Kiểm tra có quyền cụ thể không
     */
    public static function requireRole($allowedRoles = []) {
        self::requireAuth();
        
        if (!isset($_SESSION['role'])) {
            header('Location: ' . APP_URL . '/login');
            exit;
        }

        if (!empty($allowedRoles) && !in_array($_SESSION['role'], $allowedRoles)) {
            http_response_code(403);
            die('Bạn không có quyền truy cập trang này!');
        }
    }

    /**
     * Kiểm tra có permission cụ thể không
     */
    public static function requirePermission($permission) {
        self::requireAuth();
        
        $permissions = $_SESSION['permissions'] ?? [];
        
        if (!in_array($permission, $permissions)) {
            http_response_code(403);
            die('Bạn không có quyền thực hiện hành động này!');
        }
    }

    /**
     * Lấy user hiện tại
     */
    public static function getUser() {
        if (isset($_SESSION['user_id'])) {
            return [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['role'],
                'role_name' => $_SESSION['role_name']
            ];
        }
        return null;
    }

    /**
     * Đăng nhập user
     */
    public static function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role_name'];
        $_SESSION['role_name'] = $user['role_description'];
        
        // Lưu permissions
        $roleModel = new Role();
        $_SESSION['permissions'] = $roleModel->getPermissions($user['role_id']);
        
        // Regenerate session ID để chống session fixation
        session_regenerate_id(true);
    }

    /**
     * Đăng xuất
     */
    public static function logout() {
        // Xóa tất cả session data
        $_SESSION = [];
        
        // Xóa session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
    }
}
