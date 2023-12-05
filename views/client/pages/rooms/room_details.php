<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "ID from URL: $id";
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

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
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
                        <div class="side-bar-form">
                            <h3>Booking Sheet </h3>
                            <form>
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check in</label>
                                            <div class="input-group">
                                                <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class="bx bxs-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check Out</label>
                                            <div class="input-group">
                                                <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class="bx bxs-calendar"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Persons</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Rooms</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="side-bar-plan">
                            <h3>Basic Plan Facilities</h3>
                            <ul>
                                <li><a href="#">Lunch Facility</a></li>
                                <li><a href="#">Breakfast Facility</a></li>
                                <li><a href="#">Outdoor Kitchen</a></li>
                                <li><a href="#">Shampoo and Soap</a></li>
                                <li><a href="#">Dinner Facility</a></li>
                                <li><a href="#">Wireless Connectivity</a></li>
                                <li><a href="#">Double Bed</a></li>
                                <li><a href="#">5 Star Food Favor</a></li>
                            </ul>
                            <h3>Premium Plan Facilities</h3>
                            <ul>
                                <li><a href="#">Double Bed</a></li>
                                <li><a href="#">Lunch Facility</a></li>
                                <li><a href="#">Dinner Facility</a></li>
                                <li><a href="#">Breakfast Facility</a></li>
                                <li><a href="#">Outdoor Kitchen</a></li>
                                <li><a href="#">Shampoo and Soap</a></li>
                                <li><a href="#">Wireless Connectivity</a></li>
                                <li><a href="#">Mini-Bar</a></li>
                                <li><a href="#">5 Star Food Favor</a></li>
                                <li><a href="#">Buffet Dinner</a></li>
                                <li><a href="#">Satellite Tv</a></li>
                                <li><a href="#">Air Condition Facility</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="room-details-article">
                        <div class="room-details-slider owl-carousel owl-theme">
                            <div class="room-details-item">
                                <img src="<?php echo "./uploads/" . $Value->image_path  ?>" alt="Images">
                            </div>
                            <!-- <div class="room-details-item">
                                    <img src="uploads/phong-don.jpeg" alt="Images">
                                </div>
                                <div class="room-details-item">
                                    <img src="uploads/phong-don.jpeg" alt="Images">
                                </div> -->
                        </div>
                        <div class="room-details-title">
                            <h2><?php echo  $Value->name ?>/<?php echo RoomType::getNameById($Value->room_type_id);  ?></h2>
                            <ul>
                                <li>
                                    Basic :<?php echo  $Value->price_per_night ?>/Night/Room
                                </li>
                                <li>
                                    Premium :<?php echo  $Value->price_per_night ?>/Night/Room
                                </li>
                            </ul>
                        </div>
                        <div class="room-details-content">
                            <p>
                                <?php echo RoomType::getDescriptionById($Value->room_type_id);  ?>
                            </p>
                            <!-- <p>
                                    Ecespiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam,
                                    eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                    explicabo. Nemo enim
                                    ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                                    magni dolores eos qui
                                    ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quci
                                    velit modi tempora incidunt
                                    ut labore et dolore magnam aliquam quaerat .
                                </p> -->
                        </div>

                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Các Bình luận gần đây:</h3>
                                         
                                                <ul class="list-unstyled">
                                                <!-- <?php var_dump($comments); ?> -->
                                                    <?php foreach ($comments as $comment) : ?>
    <li class="media">
        <strong class="mr-2"><?php echo login::getNameById($comment->customer_id) ?>:</strong>
        <div class="media-body">
            <?php echo $comment->comment_text; ?>
            <small class="text-muted"><?php echo $comment->created_at; ?></small>
        </div>
    </li>
<?php endforeach; ?>

                                                </ul>
                                        </div>
                                    </div>

                                    <!-- Add New Comment Form -->
                                    <?php if (isset($_SESSION['user_id'])) : ?>
                                        <form action="index.php?controller=client&action=addComment&id=<?php echo $Value->id; ?>" method="post">
                                        <div class="form-group">
                                        <label for="comment_text">Nhập bình luận của bạn:</label>
                                        <input type="text" id="comment_text" name="comment_text" class="form-control" required>
                                        <input type="hidden" name="room_id" value="<?php echo $Value->id; ?>">
                                        <!-- <?php
                                        // Kiểm tra xem người dùng đã đăng nhập hay chưa
                                        if (isset($_SESSION['user_id'])) {
                                            // Nếu đã đăng nhập, thêm trường ẩn để chứa user_id
                                            echo '<input type="hidden" name="user_id" value="' . $_SESSION['user_id'] . '">';
                                        }
                                        ?> -->
                                        <button type="submit" class="btn btn-primary">Gửi Bình Luận</button>
                                    </div>
                                </form>
                                    <?php else : ?>
                                        <p class="mt-4 text-muted">Vui lòng đăng nhập để bình luận!</p>
                                    <?php endif; ?>

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
            <div class="room-details-text">
                <!-- <h2>Our Related Offer</h2> -->
            </div>
            <div class="row ">
                <div class="col-lg-6">
                    <div class="room-card-two">
                        <div class="row align-items-center">

                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="room-card-img">
                                    <a href="room-details.html">
                                        <img src="assets/img/room/room-style-img1.jpg" alt="Images">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="room-card-content">
                                    <h3>
                                        <a href="room-details.html">Luxury Room</a>
                                    </h3>
                                    <span>320 / Per Night </span>
                                    <div class="rating">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed
                                        pulvinar purus.</p>
                                    <ul>
                                        <li><i class="bx bx-user"></i> 4 Person</li>
                                        <li><i class="bx bx-expand"></i> 35m2 / 376ft2</li>
                                    </ul>
                                    <ul>
                                        <li><i class="bx bx-show-alt"></i> Sea Balcony</li>
                                        <li><i class="bx bxs-hotel"></i> Kingsize / Twin</li>
                                    </ul>
                                    <a href="room-details.html" class="book-more-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="room-card-two">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="room-card-img">
                                    <a href="room-details.html">
                                        <img src="assets/img/room/room-style-img2.jpg" alt="Images">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="room-card-content">
                                    <h3>
                                        <a href="room-details.html">Single Room</a>
                                    </h3>
                                    <span>300 / Per Night </span>
                                    <div class="rating">
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                        <i class="bx bxs-star"></i>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, adipiscing elit. Suspendisse et faucibus felis, sed
                                        pulvinar purus.</p>
                                    <ul>
                                        <li><i class="bx bx-user"></i> 1 Person</li>
                                        <li><i class="bx bx-expand"></i> 25m2 / 276ft2</li>
                                    </ul>
                                    <ul>
                                        <li><i class="bx bx-show-alt"></i> Sea Balcony</li>
                                        <li><i class="bx bxs-hotel"></i> Smallsize / Twin</li>
                                    </ul>
                                    <a href="room-details.html" class="book-more-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
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
</body>

<!-- Mirrored from templates.hibootstrap.com/atoli/default/room-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 09:54:36 GMT -->

</html>