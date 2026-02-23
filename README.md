# AP App

> Ứng dụng PHP MVC với XAMPP và Tailwind CSS

## Yêu cầu

- PHP 8.0+
- XAMPP (Apache, MySQL)
- Composer (tùy chọn)
- Node.js & npm (nếu dùng Tailwind CSS build)

## Cài đặt

### Bước 1: Clone và cấu hình

```bash
git clone https://github.com/hizhiz189/ap-app.git
cd ap-app
```

### Bước 2: Tạo database

1. Mở **phpMyAdmin** (http://localhost/phpmyadmin)
2. Tạo database mới tên `ap_app`
3. Import file `sql/migration.sql` vào database

### Bước 3: Cấu hình database

Mở file `config/db.php` và kiểm tra thông tin:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'ap_app');
define('DB_USER', 'root');    // Username XAMPP
define('DB_PASS', '');        // Password XAMPP (thường để trống)
```

### Bước 4: Cấu hình XAMPP

1. Mở **XAMPP Control Panel**
2. Start **Apache** và **MySQL**
3. Copy thư mục project vào `xampp/htdocs/ap-app/`

### Bước 5: Truy cập ứng dụng

```
http://localhost/ap-app/public
```

## Tài khoản demo

| Role    | Email              | Password   |
|---------|-------------------|------------|
| Admin   | admin@example.com | admin123   |

## Cấu trúc thư mục

```
ap-app/
├── config/
│   └── db.php           # Cấu hình database
├── controllers/
│   ├── AuthController.php
│   └── DashboardController.php
├── middleware/
│   └── AuthMiddleware.php   # Route guard
├── models/
│   ├── Database.php     # PDO Connection
│   ├── Role.php
│   └── User.php
├── public/
│   └── index.php         # Entry point
├── routes/
│   └── router.php       # Simple Router
├── sql/
│   └── migration.sql    # Database schema + seed
├── views/
│   ├── auth/
│   │   └── login.php
│   ├── dashboard/
│   │   └── index.php
│   └── layouts/
│       └── main.php
└── README.md
```

## Các tính năng

### ✅ Authentication
- Đăng nhập bằng email + mật khẩu
- Session-based auth (không JWT)
- Password hash với `password_hash()`

### ✅ Phân quyền (Role-Based Access Control)
- **Admin**: Full quyền (users, settings, reports)
- **Manager**: Quản lý dữ liệu (users, reports)
- **Viewer**: Chỉ xem (dashboard)

### ✅ Route Guard
- Chặn truy cập khi chưa đăng nhập
- Kiểm tra quyền theo từng route

### ✅ Security
- PDO Prepared Statements (chống SQL Injection)
- Session cookie HttpOnly
- Session fixation protection

## Routes

| Method | Path           | Controller           | Description        |
|--------|----------------|----------------------|-------------------|
| GET    | /              | -                    | Redirect to /login |
| GET    | /login         | AuthController@login | Hiển thị form đăng nhập |
| POST   | /login/process | AuthController@handleLogin | Xử lý đăng nhập |
| GET    | /logout        | AuthController@logout | Đăng xuất |
| GET    | /dashboard    | DashboardController@index | Trang chính |

## Git Workflow

```bash
# Tạo branch mới
git checkout -b feature/ten-feature

# Thêm thay đổi
git add .
git commit -m "Mô tả thay đổi"

# Push lên remote
git push origin feature/ten-feature

# Merge vào main
git checkout main
git merge feature/ten-feature
git push origin main
```

## Quy ước code

- Sử dụng Tailwind CSS, không dùng Bootstrap
- Thiết kế responsive (mobile-first)
- Thiết kế hiện đại, tối giản (modern SaaS style)
- Sử dụng bo góc (rounded-lg/rounded-xl) và shadow nhẹ

## License

MIT
