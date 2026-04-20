
# MoodToday
=======
# 🌟 MoodToday - Emotional Tracking System

MoodToday là một ứng dụng Web giúp người dùng theo dõi và quản lý tâm trạng hàng ngày, được xây dựng trên nền tảng Laravel hiện đại.

## 🚀 Tính năng chính
- **Daily Mood Logging:** Ghi lại tâm trạng và ghi chú cá nhân.
- **Data Visualization:** Biểu đồ thống kê tâm trạng theo tuần/tháng.
- **Secure Authentication:** Hệ thống đăng nhập bảo mật với Laravel Breeze/Fortify.
- **Responsive Design:** Giao diện tối ưu cho cả Mobile và Desktop.

## 🛠 Tech Stack
- **Backend:** Laravel 10+, PHP 8.2
- **Database:** MySQL
- **Web Server:** Nginx (Cấu hình Virtual Host trên Laragon)
- **Frontend:** Blade Template, Tailwind CSS

## ⚙️ Cấu hình Hệ thống (System Architecture)
Hệ thống được thiết kế để chạy trên kiến trúc Nginx + PHP-FPM:
1. **Nginx:** Đóng vai trò Reverse Proxy, xử lý SSL và điều hướng Request.
2. **PHP-FPM:** Xử lý logic nghiệp vụ của Laravel.
3. **MySQL:** Lưu trữ dữ liệu quan hệ với cơ chế Indexing tối ưu.

## 📦 Cài đặt
1. Clone dự án: `git clone https://github.com`
2. Cài đặt dependency: `composer install` & `npm install`
3. Cấu hình file `.env` và tạo Key: `php artisan key:generate`
4. Chạy Migration: `php artisan migrate`


