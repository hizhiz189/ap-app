<?php
/**
 * Auth Controller - Xử lý đăng nhập/đăng xuất
 */
class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Hiển thị trang đăng nhập
     */
    public function login() {
        // Nếu đã đăng nhập thì chuyển về dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/dashboard');
            exit;
        }

        $error = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        include 'views/layouts/main.php';
        include 'views/auth/login.php';
    }

    /**
     * Xử lý đăng nhập
     */
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validate input
            if (empty($email) || empty($password)) {
                $_SESSION['login_error'] = 'Vui lòng nhập email và mật khẩu!';
                header('Location: ' . APP_URL . '/login');
                exit;
            }

            // Verify credentials
            $user = $this->userModel->verifyPassword($email, $password);

            if ($user) {
                if (!$user['is_active']) {
                    $_SESSION['login_error'] = 'Tài khoản của bạn đã bị vô hiệu hóa!';
                    header('Location: ' . APP_URL . '/login');
                    exit;
                }

                // Login successful
                AuthMiddleware::login($user);
                header('Location: ' . APP_URL . '/dashboard');
                exit;
            } else {
                $_SESSION['login_error'] = 'Email hoặc mật khẩu không đúng!';
                header('Location: ' . APP_URL . '/login');
                exit;
            }
        } else {
            header('Location: ' . APP_URL . '/login');
            exit;
        }
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout() {
        AuthMiddleware::logout();
        header('Location: ' . APP_URL . '/login');
        exit;
    }
}
