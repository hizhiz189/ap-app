# AP App

> Ứng dụng PHP với XAMPP và Tailwind CSS

## Yêu cầu

- PHP 8.0+
- XAMPP (Apache, MySQL)
- Composer (nếu sử dụng)
- Node.js & npm (nếu sử dụng Tailwind CSS)

## Cài đặt

1. Clone repository:
   ```bash
   git clone https://github.com/your-username/ap-app.git
   ```

2. Di chuyển vào thư mục project:
   ```bash
   cd ap-app
   ```

3. Cấu hình XAMPP:
   - Start Apache và MySQL trong XAMPP Control Panel
   - Copy `htdocs/ap-app` vào thư mục `xampp/htdocs/`

4. Truy cập:
   ```
   http://localhost/ap-app
   ```

## Công nghệ sử dụng

- **Backend:** PHP thuần
- **Database:** MySQL (XAMPP)
- **Frontend:** Tailwind CSS
- **Server:** Apache (XAMPP)

## Quy ước code

- Sử dụng Tailwind CSS, không dùng Bootstrap
- Thiết kế responsive (mobile-first)
- Thiết kế hiện đại, tối giản (modern SaaS style)
- Sử dụng bo góc (rounded-lg/rounded-xl) và shadow nhẹ

## Git Workflow

```bash
# Clone repository
git clone https://github.com/your-username/ap-app.git

# Tạo branch mới
git checkout -b feature/ten-feature

# Thêm thay đổi
git add .
git commit -m "Mô tả thay đổi"

# Đẩy lên remote
git push origin feature/ten-feature

# Merge vào main
git checkout main
git merge feature/ten-feature
git push origin main
```

## License

MIT
