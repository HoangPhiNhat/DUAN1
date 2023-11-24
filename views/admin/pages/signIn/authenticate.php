<?php
session_start();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        // if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        //     // Chuyển hướng đến trang đăng nhập
        //     header('Location: views/admin/login.php');
        //     exit;
        // }

// Kiểm tra quyền hạn (ở đây làm ví dụ cho admin)
// if ($_SESSION['role'] !== 'admin') {
//     // Nếu không phải là admin, chuyển hướng đến trang người dùng (hoặc thực hiện xử lý khác)
//     header('Location: user-dashboard.php');
//     exit;
// }