<?php
    $checkInDatePicker = $_GET['checkin_date'];
    $checkOutDatePicker = $_GET['checkout_date'];
    $personSelect = $_GET['person'];
?>
<div class="preloader" style="display: none;">
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
            <div class="col-lg-8">
                <?php foreach ($availableRooms as $value) : ?>
                    <div class="room-details-article">
                        <div class="room-details-slider owl-carousel owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-1932px, 0px, 0px); transition: all 0.25s ease 0s; width: 6763px;">
                                    <div class="owl-item cloned" style="width: 936.008px; margin-right: 30px;">
                                        <div class="room-details-item">
                                            <img src="<?php echo "./uploads/" . $value->image_path ?>" alt="Images">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev">
                                    <i class="bx bx-chevron-left"></i>
                                </button>
                                <button type="button" role="presentation" class="owl-next">
                                    <i class="bx bx-chevron-right"></i>
                                </button>
                            </div>
                            <div class="owl-dots disabled"></div>
                        </div>
                        <div class="room-details-title">
                            <h2><?php echo RoomType::getNameById($value->room_type_id); ?></h2>
                            <div class="room_details">
                                <div class="room_details_left">
                                    <div class="fb-results-ratekeys">
                                        <div class="item ">
                                            <img src="https://www.book-secure.com/images/pictos/icon-package-mealplan-breakfast.png" border="0" style="padding-left: 6px;">
                                            <span class="fb-translate">Bao gồm bữa sáng</span>
                                        </div>

                                    </div>
                                    <div class="fb-results-ratekeys">
                                        <div class="item  ">
                                            <img src="https://www.book-secure.com/images/pictos/icon-package-salesterms-cross.png" border="0">
                                            <span class="fb-translate">Không thể hủy, sửa đổi</span>
                                        </div>
                                    </div>
                                    <div class="fb-results-ratekeys">
                                        <div class="item">
                                            <img src="https://www.book-secure.com/images/pictos/icon-package-salesterms-payment-checkout.png" border="0">
                                            <span class="fb-translate">Thanh toán sau</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="room_details_right">
                                    <p style="display: block; margin: 0;">
                                        1 đêm / <?php echo $value->capacity ?> người
                                    </p>
                                    <p>
                                    <h2> <?php echo $value->price_per_night ?> VNĐ</h2>
                                    </p>
                                    <button type="button" class="default-btn btn-bg-three" data-room="<?php echo $value->id; ?>" data-price="<?php echo $value->price_per_night ?>" data-checkin="<?php echo $checkInDatePicker; ?>" data-checkout="<?php echo $checkOutDatePicker; ?>">
                                        Chọn
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="room-details-content">
                        <p>
                            <?php echo RoomType::getDescriptionById($value->room_type_id); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form action="index.php?controller=client&action=roomSelection" method="POST">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Ngày đặt phòng</label>
                                        <div class="input-group date">
                                            <input id="checkInDatePicker" name="checkInDatePicker" required type="text" class="form-control" disabled placeholder="<?php echo $checkInDatePicker ?>">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class="bx bxs-calendar"></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Ngày trả phòng</label>
                                        <div class="input-group">
                                            <input id="checkOutDatePicker" name="checkOutDatePicker" required type="text" class="form-control" disabled placeholder="<?php echo $checkOutDatePicker ?>">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class="bx bxs-calendar"></i>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Số người </label>
                                        <select class="custom-select" id="personSelect" name="personSelect">
                                            <option value="<?= $personSelect ?>" disabled selected><?= $personSelect ?></option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let paymentButtons = document.querySelectorAll('.default-btn.btn-bg-three');

    paymentButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            let roomTypeId = this.getAttribute('data-room');
            let price = this.getAttribute('data-price');
            let checkinDate = this.getAttribute('data-checkin');
            let checkoutDate = this.getAttribute('data-checkout');

            redirectToPaymentPage(roomTypeId, price, checkinDate, checkoutDate);
        });
    });

    function redirectToPaymentPage(roomTypeId, price, checkinDate, checkoutDate) {
        window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" + checkinDate + "&checkout_date=" + checkoutDate + "&bookRoom=" + roomTypeId + "&price=" +price;
    }
});

</script>