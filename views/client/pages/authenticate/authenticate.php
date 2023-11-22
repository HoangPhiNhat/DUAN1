<?php
session_start();


// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    exit();
}

// Nếu đăng nhập rồi, hiển thị trang người dùng
echo "Welcome, User!";
?>


// Kiểm tra quyền hạn (ở đây làm ví dụ cho admin)
// if ($_SESSION['role'] !== 'admin') {
//     // Nếu không phải là admin, chuyển hướng đến trang người dùng (hoặc thực hiện xử lý khác)
//     header('Location: user-dashboard.php');
//     exit;
// }