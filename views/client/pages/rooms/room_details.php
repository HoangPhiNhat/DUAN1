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
            <div class="row pt-45">
                <!-- <div class="col-md-6"> -->
                <div class="container mt-5 d-flex align-items-center justify-content-center">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <p> <?php echo $roomDetails->name; ?></p>
                                <p>Số Lượng Người Một Phòng: <?php echo $roomDetails->capacity; ?></p>
                                <p>Giá Tiền: <?php echo $roomDetails->price_per_night; ?> / Per Night</p>

                                <!-- <?php echo Rooms::getImagePathId($roomDetails->image_path); ?> -->
                            </div>
                            <div class="col-md-6 text-center">
                                <p>Cơ Sở: <?php echo Facility::getNameById($roomDetails->facility_id); ?></p>
                                <p>Loại Phòng: <?php echo RoomType::getNameById($roomDetails->room_type_id); ?></p>
                                <a href="index.php?controller=client&action=bookNow&room_id=<?php echo $roomDetails->id; ?>" class="btn btn-primary mt-3 book-btn">Book Now</a>
                            </div>
                        </div><br>
                        <a href="room-details.html">
                            <img src="uploads/phong-don.jpeg" alt="" class="img-fluid" style="height: auto; width: 100%;">
                        </a><br>

                        <!-- Other room details -->

                        <p style=" overflow: hidden; text-overflow: ellipsis; max-width: 50vw; ">
                            Mô Tả:
                            <?php echo RoomType::getDescriptionById($roomDetails->room_type_id); ?> <br>
                        </p>
                        <div>
                            <div class="add-comment">
                                <h3>Comment</h3>
                                <form action="#" method="post" class="border p-3">
                                <div class="form-group">
                                        <label for="comment_text">comments:</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment_text">Comment Here:</label>
                                        <input class="" id="" name="" required></input>
                                        <button type="submit" class="btn btn-primary">Submit Comment</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="room-details-title">
                            <h2><?php echo RoomType::getNameById($Value->room_type_id);  ?></h2>
                            <ul>
                                <li>
                                    Giá :<?php echo  $Value->price_per_night ?>
                                </li><br>
                                <li>
                                  Số Lượng:  <?php echo  $Value->capacity ?>/Người
                                </li>
                            </ul>
                        </div>
                        <div class="room-details-content">
                            <p>
                                <?php echo RoomType::getDescriptionById($Value->room_type_id);  ?>
                            </p>
                        </div>
                        <div class="container mt-4" >
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
                    <!-- </div> -->
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

<!-- Mirrored from templates.hibootstrap.com/atoli/default/room.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 09:54:34 GMT -->

</html>