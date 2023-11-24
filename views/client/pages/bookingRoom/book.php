<?php
// Đặt ngày hiện tại
$currentDate = date("m/d/Y");
?>
<div class="inner-banner inner-bg5">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Booking</li>
            </ul>
            <h3>Booking</h3>
        </div>
    </div>
</div>
<div class="book-area pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="book-img">
                    <img src="assets/img/book-img.jpg" alt="Images">
                    <div class="book-shape">
                        <img src="assets/img/shape/shape1.png" alt>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="booking-form">
                    <h3>Booking Sheet </h3>
                    <form action="index.php?controller=client&action=bookNow" method="POST">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Nhập họ và tên của bạn" value="<?= $InfoUser['name'] ?>">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="Nhập email của bạn" value="<?= $InfoUser['email'] ?>">
                                    <i class="bx bx-mail-send"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required placeholder="Nhập số điện thoại của bạn" value="<?= $InfoUser['phone'] ?>">
                                    <i class="bx bx-phone"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Loại phòng</label>
                                    <select class="form-control" id="roomTypeSelect" name="room_type_id">
                                        <option value="0" selected disabled>Tất cả</option>
                                        <?php foreach ($roomType as $value) : ?>
                                            <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ngày đặt phòng</label>
                                    <div class="input-group date">
                                        <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class="bx bxs-calendar"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ngày trả phòng</label>
                                    <div class="input-group">
                                        <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class="bx bxs-calendar"></i>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn btn-bg-two border-radius-5">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>