<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo "ID from URL: $id";
    $Value = Rooms::findALLData($id);

    if (!$Value) {
        echo "Room not found.";
    }
} else {
    echo "Room ID not provided.";
}

?>
<?php
if (isset($roomDetails)) {
    // Đoạn mã sử dụng $roomDetails ở đây
} else {
    echo "Không có thông tin về phòng.";
}
?>
<!doctype html>
<html lang="zxx">

<!-- Mirrored from templates.hibootstrap.com/atoli/default/room-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 09:54:34 GMT -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.min.css">

    <link rel="stylesheet" href="assets/fonts/flaticon.css">

    <link rel="stylesheet" href="assets/css/boxicons.min.css">

    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="assets/css/nice-select.min.css">

    <link rel="stylesheet" href="assets/css/meanmenu.css">

    <link rel="stylesheet" href="assets/css/jquery-ui.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="assets/css/theme-dark.css">

    <link rel="stylesheet" href="path/to/owl.carousel.min.css">
    <script src="path/to/owl.carousel.min.js"></script>

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-W3m04Oy7j56RBCn6oFDbd1UpyHZcEElahzdtPDijur5NzwF/RtfbdBXGcfO1PdBl" crossorigin="anonymous">

    <style>
        .rating {
            color: #ef760b;
            /* Yellow color */
        }

        .comment-container {
            border: 1px solid #e0e0e0;
            padding: 15px;
            margin-top: 15px;
        }
    </style>
    <title>Atoli - Hotel & Resorts HTML Template</title>
</head>

<body>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="sk-cube-area">
                    <div class="sk-cube1 sk-cube"></div>
                    <div class="sk-cube2 sk-cube"></div>
                    <div class="sk-cube4 sk-cube"></div>
                    <div class="sk-cube3 sk-cube"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-banner inner-bg10">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>Room Details </li>
                </ul>
                <h3>Room Details</h3>
            </div>
        </div>
    </div>



    <div class="room-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="room-details-side">

                        <div class="side-bar-plan">
                            <div>
                                <h3 style="border-bottom: 1px dashed; padding: 10px;">Tiện Nghi</h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7cb/182/6077cb18254ca947264346.svg" alt=""> Wi-Fi miễn phí trong phòng
                                    </li>

                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7cb/569/6077cb56953b3924040946.svg" alt="">Tivi
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c6/a80/6077c6a8021a7377939554.svg" alt="">Điện thoại bàn
                                    </li>
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c7/050/6077c7050a282631755660.svg" alt="">Đèn ngủ
                                    </li>
                                </ul>
                                <ul class="list-unstyled">

                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bc/569/6077bc5697c45900912021.svg" alt="">Tủ lạnh
                                    </li>
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7ca/d80/6077cad80b752086833352.svg" alt="">Ấm đun nước
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c0/dc8/6077c0dc805e2209555953.svg" alt="">Máy sấy tóc
                                    </li>
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c0/96e/6077c096e6ab8328651650.svg" alt="">Nệm gấp gọn
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c3/56b/6077c356b8432428133568.svg" alt="">Hộp khăn giấy
                                    </li>
                                    <li>
                                        <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c3/38b/6077c338b10e1685649966.svg" alt="">Hộp sơ cứu
                                    </li>
                                </ul>
                                <div id="facilities" style="display: none;">
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c3/6f5/6077c36f52836287661244.svg" alt="">Gương trong phòng tắm
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c5/289/6077c5289ff45278754275.svg" alt="">Ghế
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7ca/a59/6077caa59f7a0758785107.svg" alt="">Áo choàng tắm
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c8/215/6077c821551c0492700039.svg" alt="">Dép trong phòng
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c3/dd0/6077c3dd0950d892676582.svg" alt="">Gương trang điểm
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7ca/4c9/6077ca4c902f3937627627.svg" alt="">Bàn Làm Việc
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c9/d4e/6077c9d4ea611638738305.svg" alt="">Bồn rửa
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c9/a8d/6077c9a8d6529671154255.svg" alt="">Bồn vệ sinh
                                        </li>
                                    </ul>

                                </div>
                                <ul>
                                    <li> <a href="#" onclick="toggleContent('facilities')">Chi tiết</a></li>
                                </ul>
                            </div>
                            <div>
                                <h3 style="border-bottom: 1px dashed; border-top: 1px solid; padding: 10px;">Các Loại Dịch Vụ </h3>
                                <ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bd/fd7/6077bdfd7489f967133370.svg" alt="">Sân vườn
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7be/286/6077be286137c112291671.svg" alt="">PINT BEER
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bc/e4d/6077bce4df775970398996.svg" alt="">The Lobby bar&amp;coffee
                                        </li>

                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7be/e70/6077bee70a82e820551500.svg" alt="">Nhà hàng
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bd/0ec/6077bd0ec61a1291824577.svg" alt="">Thang máy
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c2/6da/6077c26da910f708923695.svg" alt="">Két an toàn
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bc/96b/6077bc96b238b626959026.svg" alt="">Trà miễn phí
                                        </li>
                                        <li>
                                            <img class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7be/4aa/6077be4aa25e2834096560.svg" alt="">Nước đóng chai miễn phí
                                        </li>
                                    </ul>
                                    <div id="services" style="display: none;">
                                    <ul class="list-unstyled">
                                    <li>
                      <img
                        class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7ca/8a7/6077ca8a779fe594121700.svg"
                        alt="">Bãi đậu xe</li>
                    <li>
                      <img
                        class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7c7/fd2/6077c7fd2d73b812800312.svg"
                        alt="">Dịch vụ đưa đón</li>
                  </ul>
                  <ul class="list-unstyled">
                    <li>
                      <img
                        class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bd/888/6077bd8880954180611559.svg"
                        alt="">Sân Golf</li>
                        
                    <li>
                      <img
                        class="facility-icon" width="30" src="https://hotelcolline.com/storage/app/uploads/public/607/7bd/fd7/6077bdfd7489f967133370.svg"
                        alt="">Sân vườn</li>
                 
                  </ul><ul class="list-unstyled">
                    
                    <li>
                      <img
                        class="facility-icon" width="30" src="https://cdn2.iconfinder.com/data/icons/medical-healthcare-26/28/Barbell-512.png"
                        alt="">Phòng GYM</li>
                        <li>
                      <img
                        class="facility-icon" width="30" src="https://cdn0.iconfinder.com/data/icons/summer-and-holiday-line-vol-2/80/dumbbell__fitness__exercise__gym__weight-128.png"
                        alt="">Bể Bơi</li>
                 
                  </ul>
                                    </div>
                                    <ul>
        <li><a href="#" onclick="toggleServices()">Chi tiết Dịch Vụ</a></li>
    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="room-details-article">
                        <h2>Thông Tin Phòng</h2>
                        <div class="room-details-slider owl-carousel owl-theme">
                            <div class="room-details-item">
                                <img src="<?php echo "./uploads/" . $Value->image_path  ?>" alt="Images" style=" margin-left: 62px; width: 87%;">
                            </div>
                        </div>
                        <div class="room-details-title">
                            <h2><?php echo RoomType::getNameById($Value->room_type_id);  ?></h2>
                            <ul>
                                <li>
                                    Giá :<?php echo  $Value->price_per_night ?>
                                </li><br>
                                <li>
                                    Số Lượng: <?php echo  $Value->capacity ?>/Người
                                </li>
                            </ul>
                        </div>
                        <div class="room-details-content">
                            <p>
                                <?php echo RoomType::getDescriptionById($Value->room_type_id);  ?>
                            </p>
                        </div>
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-8" style="width: 150%;">
                                    <h3 class="card-title">Bình luận</h3>
                                    <div class="comment-container">
                                        <?php if (isset($_SESSION['user_id'])) : ?>
                                            <form action="index.php?controller=client&action=addComment&id=<?php echo $Value->id; ?>" method="post">
                                                <div class="form-group row">
                                                    <label for="rating" class="col-sm-12 col-form-label">Đánh giá:</label>
                                                    <div class="col-sm-3" style="width: 461px;">
                                                        <div class="rating">
                                                            <input type="radio" id="star5" name="rating" value="5" required>
                                                            <label for="star5">&#9733;&#9733;&#9733;&#9733;&#9733;</label>

                                                            <input type="radio" id="star4" name="rating" value="4" required>
                                                            <label for="star4">&#9733;&#9733;&#9733;&#9733;&#9734;</label>

                                                            <input type="radio" id="star3" name="rating" value="3" required>
                                                            <label for="star3">&#9733;&#9733;&#9733;&#9734;&#9734;</label>

                                                            <input type="radio" id="star2" name="rating" value="2" required>
                                                            <label for="star2">&#9733;&#9733;&#9734;&#9734;&#9734;</label>

                                                            <input type="radio" id="star1" name="rating" value="1" required>
                                                            <label for="star1">&#9733;&#9734;&#9734;&#9734;&#9734;</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="comment_text" class="col-sm-12 col-form-label">Nhập bình luận của bạn:</label>

                                                    <div class="col-sm-5">
                                                        <input type="text" id="comment_text" name="comment_text" class="form-control" required>
                                                        <input type="hidden" name="room_id" value="<?php echo $Value->id; ?>">
                                                        <?php
                                                        if (isset($_SESSION['user_id'])) {
                                                            echo '<input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary">Gửi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php else : ?>
                                            <p class="mt-4 text-muted">Vui lòng đăng nhập để bình luận và đánh giá!</p>
                                        <?php endif; ?>
                                        <?php foreach ($comments as $comment) : ?>
                                            <div class="media" style="font-size: 12px; border-bottom: 0.5px solid #ccc; padding-top: 10px;"> <!-- Adjust the font size and styling here -->
                                                <img src="./uploads/tải xuống.jfif" alt="" style="width: 54px; height: 55px; margin-top: 10px;" class="mr-3">
                                                <div class="media-body">
                                                    <h6 class="mt-0"><?php echo login::getNameById($comment->customer_id); ?></h6>
                                                    <div style="max-width: 500px; height: 65px;">
                                                        <p style="height: 12px"><?php echo $comment->comment_text; ?></p>
                                                        <p>Đánh Giá: <span style="color: #ef760b;"><?php echo Comment::displayStarRating($comment->rating); ?></span></p>
                                                    </div>
                                                </div>
                                                <small class="text-muted"><?php echo $comment->created_at; ?></small>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="room-details-other pb-70">
        <div class="container">
            <div class="room-details-text text-center">
                <h2>Our Related Offer</h2>
            </div>
            <div class="row ">
                <div>
                    <div class="room-card-two room-slider owl-carousel owl-theme pt-45">
                        <?php foreach ($samerooms as $similarRoom) : ?>
                            <div class="item">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-md-4 ">
                                        <div class="room-card-img" style="margin: -16px;">
                                            <a href="index.php?controller=client&action=room_details&id=<?php echo $similarRoom->id; ?>">
                                                <img src="<?php echo "./uploads/" . $similarRoom->image_path  ?>" alt="Images" style="height: 150px;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-8 p-0">
                                        <div class="room-card-content">
                                            <h3>
                                                <a href="index.php?controller=client&action=room_details&id=<?php echo $similarRoom->id; ?>" style="color: black;">
                                                    <?php echo RoomType::getNameById($similarRoom->room_type_id);  ?>
                                                </a>
                                            </h3>
                                            <span><?php echo $similarRoom->price_per_night; ?></span>
                                            <div class="rating">
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                                <i class="bx bxs-star"></i>
                                            </div>
                                            <ul>
                                                <li><i class="bx bx-user"></i><?php echo $similarRoom->capacity; ?></li>
                                            </ul>
                                            <ul>
                                                <li><i class="bx bx-show-alt"></i> Sea Balcony</li>
                                                <li><i class="bx bxs-hotel"></i><?php echo RoomType::getNameById($similarRoom->room_type_id);  ?>/<?php echo $similarRoom->name; ?></li>
                                            </ul>
                                            <a href="room-details.html?id=<?php echo $similarRoom->id; ?>" class="book-more-btn">
                                                Book Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/jquery.magnific-popup.min.js"></script>

    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="assets/js/jquery.nice-select.min.js"></script>

    <script src="assets/js/wow.min.js"></script>

    <script src="assets/js/jquery-ui.js"></script>

    <script src="assets/js/meanmenu.js"></script>

    <script src="assets/js/jquery.ajaxchimp.min.js"></script>

    <script src="assets/js/mixitup.min.js"></script>

    <script src="assets/js/form-validator.min.js"></script>

    <script src="assets/js/contact-form-script.js"></script>

    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $(".room-slider").owlCarousel({
                items: 2,
                loop: true,
                margin: 100,
            });
        });
    </script>
    <script>
        function toggleContent(contentId) {
            var content = document.getElementById(contentId);
            if (content.style.display === 'block' || content.style.display === '') {
                content.style.display = 'none';
            } else {
                content.style.display = 'block';
            }
        }
        function toggleServices() {
        toggleContent('services');
    }
    </script>
</body>

</html>