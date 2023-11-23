<!doctype html>
<html lang="zxx">

<!-- Mirrored from templates.hibootstrap.com/atoli/default/room.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 09:54:34 GMT -->

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


    <div class="room-area pt-100 pb-70">
        <div class="container">
            <div class="section-title text-center">
                <h5 class="sp-color">Room Details</h5>
                <!-- <h2>Our Rooms & Rates</h2> -->
            </div>
            <div class="row pt-45">
                <!-- <div class="col-md-6"> -->
                <div class="container mt-5 d-flex align-items-center justify-content-center">
                    <div>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Tên Phòng: <?php echo $roomDetails->name; ?></p>
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