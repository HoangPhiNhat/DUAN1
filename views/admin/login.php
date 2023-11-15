<?php
session_start();

// Include file kết nối CSDL
include 'D:/FPT/PHP/DUAN1/config/database.php';

// Kiểm tra nếu có dữ liệu được gửi từ form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Lấy thông tin admin từ CSDL
        $sql = "SELECT * FROM users WHERE username = ?";
        $admin = pdo_query_one($sql, $username);

        if ($admin && $admin["password"] === $password) {
            // Đăng nhập thành công
            $_SESSION['admin_id'] = $admin['id'];

            header('Location: ');
            exit();
            // Chuyển hướng đến trang quản trị sau khi đăng nhập thành công
        } else {
            // Đăng nhập thất bại
            $error = "Invalid username or password";
        }
    } catch (PDOException $e) {
        // Xử lý lỗi CSDL
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username"><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>