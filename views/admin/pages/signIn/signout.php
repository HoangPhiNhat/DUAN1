<?php
session_start();
session_unset();
session_destroy();

// Chuyển hướng đến trang đăng nhập sau khi đăng xuất
header('Location: login.php');
exit;
