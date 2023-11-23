<?php session_start(); ?>

<!DOCTYPE html>
<html lang="vn">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="views/client/assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="views/client/assets/css/animate.min.css">

    <link rel="stylesheet" href="views/client/assets/fonts/flaticon.css">

    <link rel="stylesheet" href="views/client/assets/css/boxicons.min.css">

    <link rel="stylesheet" href="views/client/assets/css/magnific-popup.css">

    <link rel="stylesheet" href="views/client/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="views/client/assets/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="views/client/assets/css/nice-select.min.css">

    <link rel="stylesheet" href="views/client/assets/css/meanmenu.css">

    <link rel="stylesheet" href="views/client/assets/css/jquery-ui.css">

    <link rel="stylesheet" href="views/client/assets/css/style.css">

    <link rel="stylesheet" href="views/client/assets/css/responsive.css">

    <link rel="stylesheet" href="views/client/assets/css/theme-dark.css">

    <link rel="icon" type="image/png" href="views/client/assets/img/favicon.png">
    <title>Atoli - Hotel & Resorts HTML Template</title>
</head>

<body>
    <div class="navbar-area">

        <div class="mobile-nav">
            <a href="index.html" class="logo">
                <img src="views/client/assets/img/logos/logo-2.png" class="logo-one" alt="Logo">
                <img src="views/client/assets/img/logos/footer-logo2.png" class="logo-two" alt="Logo">
            </a>
        </div>

        <div class="main-nav nav-two">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="index.html">
                        <img src="views/client/assets/img/logos/logo-2.png" class="logo-one" alt="Logo">
                        <img src="views/client/assets/img/logos/footer-logo2.png" class="logo-two" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <a href="index.php?controller=client&action=home" class="nav-link active">
                                    Trang chủ
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="index.php?controller=client&action=rooms" class="nav-link">
                                    Phòng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Nhà hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Dịch vụ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Blog
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="index.php?controller=client&action=aboutUs" class="nav-link">
                                    Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?controller=client&action=Contact" class="nav-link">
                                    Liên hệ
                                </a>
                            </li>
                        </ul>
                        <div class="other-option">
                            <div class="option-item d-line">
                                <div class="account-nav-list">
                                    <span class="account-btn">
                                        <?php if (isset($_SESSION['user_name'])) : ?>
                                            <div class="nice-select form-control" tabindex="0">
                                                <span class="current">
                                                    <?php echo "Xin chào, " . $_SESSION['user_name'] . "!"; ?>
                                                </span>
                                                <ul class="list">
                                                    <li class="option">
                                                        <a href="blog-1.html" class="nav-link">
                                                            Lịch sử đặt phòng
                                                        </a>
                                                    </li>
                                                    <li class="option">
                                                        <a href="blog-1.html" class="nav-link">
                                                            Cài đặt
                                                        </a>
                                                    </li>
                                                    <li class="option">
                                                        <a href="index.php?controller=client&action=logOut" class="nav-link">
                                                           Đăng xuất
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php else : ?>
                                            <a href="index.php?controller=client&action=register" class="nav-link">Đăng nhập / Đăng ký</a>
                                        <?php endif; ?>

                                    </span>
                                </div>
                            </div>
                            <div class="option-item d-in-line">
                                <div class="menu-icon">
                                    <a href="#" class="burger-menu menu-icon-one d-in-line">
                                        <i class="bx bx-menu"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="side-nav-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="circle-inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="side-nav-inner">
                        <div class="side-nav justify-content-center align-items-center">
                            <div class="side-item">
                                <div class="option-item">
                                    <div class="language-option-list">
                                        <a href="index.php?controller=client&action=register" class="nav-link">
                                            Đăng ký
                                            git</a>
                                    </div>
                                </div>
                            </div>
                            <div class="side-item">
                                <div class="option-item">
                                    <div class="menu-icon">
                                        <a href="#" class="burger-menu menu-icon-one">
                                            <i class="bx bx-menu"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-modal">
        <div class="sidebar-modal-inner">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="views/client/assets/img/logos/logo-2.png" class="sidebar-logo-one" alt="Image">
                    <img src="views/client/assets/img/logos/footer-logo2.png" class="sidebar-logo-two" alt="Image">
                </div>
                <span class="close-btn sidebar-modal-close-btn">
                    <i class="bx bx-x"></i>
                </span>
            </div>
            <div class="sidebar-about">
                <div class="title">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit, sed do eiusmod tempor
                        incididunt ut tur incidunt ut labore et
                    </p>
                </div>
            </div>
            <div class="sidebar-room-feed">
                <h2>Room Gallery</h2>
                <ul class="sidebar-room-content">
                    <li>
                        <img src="views/client/assets/img/room/room-img1.jpg" alt="Images">
                        <div class="content">
                            <h3><a href="room-details.html">Single Room</a></h3>
                            <span>320 / Per Night </span>
                        </div>
                    </li>
                    <li>
                        <img src="views/client/assets/img/room/room-img2.jpg" alt="Images">
                        <div class="content">
                            <h3><a href="room-details.html">Luxury Room</a></h3>
                            <span>360 / Per Night </span>
                        </div>
                    </li>
                    <li>
                        <img src="views/client/assets/img/room/room-img3.jpg" alt="Images">
                        <div class="content">
                            <h3><a href="room-details.html">Double Room</a></h3>
                            <span>370 / Per Night </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="contact-us">
                <h2>Contact Us</h2>
                <ul>
                    <li>
                        <i class="bx bx-current-location"></i>
                        Address: 123 Stanton, <br> Virginia, USA
                    </li>
                    <li>
                        <i class="bx bx-mail-send"></i>
                        <a href="https://templates.hibootstrap.com/cdn-cgi/l/email-protection#b2dad7dededdf2d3c6dddedb9cd1dddf"><span class="__cf_email__" data-cfemail="81e9e4ededeec1e0f5eeede8afe2eeec">[email&#160;protected]</span></a>
                        <a href="#">Skype: example</a>
                    </li>
                    <li>
                        <i class="bx bx-phone-call"></i>
                        <a href="tel:+1(123)-456-7890"> +1 (123) 456 7890</a>
                        <a href="tel:+1(123)-456-6790"> +1 (123) 456 6790</a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-follow-us">
                <h2>Follow Us</h2>
                <ul class="social-wrap">
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank">
                            <i class="bx bxl-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>