<?php
$checkInDatePicker = $_GET['checkin_date'];
$checkOutDatePicker = $_GET['checkout_date'];
$personSelect = $_GET['person'];
echo $_SESSION['user_id'];


?>



</script>
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
                <?php if (isset($availableRooms) && !empty($availableRooms)) : ?>
                    <?php $displayedTypes = array();

                    foreach ($availableRooms as $value) :
                        $roomTypeId = $value->room_type_id;
                        if (!in_array($roomTypeId, $displayedTypes)) :
                    ?>
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
                                   
                                    <?php if (!empty($roomTypeCounts)) : ?>
                                    <ul>
                                        <?php foreach ($roomTypeCounts as $roomTypeCount) : ?>
                                            <?php if ($value->room_type_id == $roomTypeCount['room_type_id']) : ?>
                                                <li>
                                                    <strong><a href="index.php?controller=client&action=room_details&id=<?= $value->id ?>" style="color: black;"><?php echo RoomType::getNameById($value->room_type_id) ?></a> - <a style="color: black;"> Số Lượng: <?php echo $roomTypeCount['room_count']; ?></a></strong> <br>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
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
                                            <input type="hidden" id="selectedRoom" name="selectedRoom" value="<?php echo $value->id; ?>">
                                            <button type="button" class="default-btn btn-bg-three selectRoom" data-nameRoom="<?php echo RoomType::getNameById($value->room_type_id); ?>" data-room="<?php echo $value->id; ?>" data-person="<?php echo $value->capacity ?>" data-price="<?php echo $value->price_per_night ?>" data-checkin="<?php echo $checkInDatePicker; ?>" data-checkout="<?php echo $checkOutDatePicker; ?>">
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
                    <?php
                            $displayedTypes[] = $roomTypeId;
                        endif;
                    endforeach;
                    ?>
                <?php else : ?>
                    <p>Không có phòng trống cho thời gian và số người đã chọn.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Thông tin đặt phòng</h3>
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <form id="roomForm" class="form-group" onsubmit="applyChangesURL(); return false;">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Ngày đặt phòng</label>
                                                <div class="input-group date">
                                                    <input id="checkInDatePicker" name="checkInDatePicker" type="text" class="form-control" readonly value="<?php echo $checkInDatePicker ?>">
                                                    <span class="input-group-addon"></span>
                                                </div>
                                                <i class="bx bxs-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Ngày trả phòng</label>
                                                <div class="input-group">
                                                    <input id="checkOutDatePicker" name="checkOutDatePicker" type="text" class="form-control" readonly value="<?php echo $checkOutDatePicker ?>">
                                                    <span class="input-group-addon"></span>
                                                </div>
                                                <i class="bx bxs-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="roomForms" class="form-group">
                                                <div class="form-group room-form">
                                                    <label>Phòng 1 - Số người</label>
                                                    <select class="custom-select" id="personSelect" name="personSelect">
                                                        <?php
                                                        $selectedPerson = isset($_GET['person']) ? $_GET['person'] : 1;
                                                        for ($i = 1; $i <= 4; $i++) {
                                                            echo '<option value="' . $i . '"';
                                                            if ($selectedPerson == $i) {
                                                                echo ' selected';
                                                            }
                                                            echo '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="default-btn" style="
                                            float: left;
                                            background-color: #ee786c;
                                            color: #fff !important;
                                            padding: 12px 42px;
                                            width: auto;" type="button" id="addButton" onclick="addPerson()">Thêm Phòng</button>
                                            <button class="default-btn" style="
                                            float: right;
                                            background-color: #ee786c;
                                            color: #fff !important;
                                            padding: 12px 42px;
                                            width: auto;" type="submit" id="applyButton">Áp dụng</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Chọn phòng</h3>
                        <form action="index.php?controller=client&action=roomSelection" method="POST">
                            <div class="row align-items-center">
                                <div class="choose-rooms">
                                    <div class="col-lg-12 room-selection-container">
                                        <div class="choose-room" id="roomSelectionForm-1">
                                            <span>Chọn phòng 1</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <span>Tổng:</span>
                                        <span></span>
                                    </div>
                                </div> -->
                                <div class="col-lg-12">
                                    <button class="default-btn" style="
                                    background-color: #ee786c;
                                    color: #fff !important;
                                    padding: 12px 42px;" type="button" name="submitBooking" id="submitBooking" data-checkin="<?php echo $checkInDatePicker; ?>" data-checkout="<?php echo $checkOutDatePicker; ?>">Kế tiếp</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<?php if (!isset($_SESSION['user_id'])) : ?>
    <script>
        document.getElementById("submitBooking").addEventListener("click", function() {

            Swal.fire({
                icon: "error",
                text: "Vui lòng đăng nhập để tiếp tục thanh toán!",
                footer: 'Bạn đã có tài khoản ? <a href="http://localhost/DUAN1/index.php?controller=client&action=signIn">&ensp; Đăng nhập</a>'
            });
        });
    </script>
<?php endif; ?>
<?php if (isset($_SESSION['user_id'])) : ?>

    <script>
        document.getElementById("submitBooking").addEventListener("click", function() {
            let checkinDate = this.getAttribute("data-checkin");
            let checkoutDate = this.getAttribute("data-checkout");

            let dataRoomElement1 = document.querySelector("#hpn-1 .customRoomLabel .itemLeft p[data-room] ");
            let dataRoomElement2 = document.querySelector("#hpn-2 .customRoomLabel .itemLeft p[data-room] ");
            let dataRoomElement3 = document.querySelector("#hpn-3 .customRoomLabel .itemLeft p[data-room] ");

            let dataRoomValue1 = dataRoomElement1 ? dataRoomElement1.getAttribute("data-room") : null;
            let dataRoomValue2 = dataRoomElement2 ? dataRoomElement2.getAttribute("data-room") : null;
            let dataRoomValue3 = dataRoomElement3 ? dataRoomElement3.getAttribute("data-room") : null;
            let dataRoomPrice1 = dataRoomElement1 ? dataRoomElement1.getAttribute("data-price") : null;
            let dataRoomPrice2 = dataRoomElement2 ? dataRoomElement2.getAttribute("data-price") : null;
            let dataRoomPrice3 = dataRoomElement3 ? dataRoomElement3.getAttribute("data-price") : null;

            if (dataRoomValue1 && dataRoomValue2 && dataRoomValue3) {
                window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                    checkinDate +
                    "&checkout_date=" +
                    checkoutDate +
                    "&Room1=" +
                    dataRoomValue1 +
                    "&price1=" +
                    dataRoomPrice1 +
                    "&Room2=" +
                    dataRoomValue2 +
                    "&price2=" +
                    dataRoomPrice2 +
                    "&Room3=" +
                    dataRoomValue3 +
                    "&price3=" +
                    dataRoomPrice3;
            } else if (dataRoomValue1 && dataRoomValue2) {
                window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                    checkinDate +
                    "&checkout_date=" +
                    checkoutDate +
                    "&Room1=" +
                    dataRoomValue1 +
                    "&price1=" +
                    dataRoomPrice1 +
                    "&Room2=" +
                    dataRoomValue2 +
                    "&price2=" +
                    dataRoomPrice2;
            } else if (dataRoomValue1) {
                window.location.href = "index.php?controller=client&action=secureBooking&checkin_date=" +
                    checkinDate +
                    "&checkout_date=" +
                    checkoutDate +
                    "&Room1=" +
                    dataRoomValue1 +
                    "&price1=" +
                    dataRoomPrice1;
            } else {
                console.log("Không thể lấy giá trị data-room.");
            }
        });
    </script>
<?php endif; ?>

<script src="views/client/pages/booking/roomSelect.js"></script>