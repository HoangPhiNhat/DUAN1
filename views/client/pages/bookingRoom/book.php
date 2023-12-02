<?php
// Đặt ngày hiện tại
$currentDate = date("d/m/Y");

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
                    <img src="views/client/assets/img/book-img.jpg" alt="Images">
                    <div class="book-shape">
                        <img src="views/client/assets/img/shape/shape1.png" alt>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="booking-form">
                    <h3>Tìm phòng </h3>
                    <form action="index.php?controller=client&action=roomSelection" method="POST">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Số người </label>
                                    <select class="custom-select" id="personSelect" name="personSelect">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Ngày đặt phòng</label>
                                    <div class="input-group date">
                                        <input id="checkInDatePicker" name="checkInDatePicker" required type="text" class="form-control" value="<?php echo $currentDate ?>">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class="bx bxs-calendar"></i>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Ngày trả phòng</label>
                                    <div class="input-group">
                                        <input id="checkOutDatePicker" name="checkOutDatePicker" required type="text" class="form-control" value="<?php echo $currentDate ?>">
                                        <span class="input-group-addon"></span>
                                    </div>
                                    <i class="bx bxs-calendar"></i>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="button" id="searchRoomBtn" class="default-btn btn-bg-two border-radius-5" data-person="">
                                   Tìm phòng
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
   $(document).ready(function() {
    $("#checkInDatePicker, #checkOutDatePicker").datepicker({
        minDate: "<?php echo $currentDate; ?>",
        dateFormat: 'dd/mm/yy' // Định dạng ngày tháng năm
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchRoomBtn').addEventListener('click', function() {
        var selectedPerson = document.getElementById('personSelect').value;
        var checkinDate = document.getElementById('checkInDatePicker').value;
        var checkoutDate = document.getElementById('checkOutDatePicker').value;

        // Kiểm tra nếu ngày trả phòng không hợp lệ
        if (!isValidCheckoutDate(checkinDate, checkoutDate)) {
            alert("Ngày trả phòng phải lớn hơn ngày hiện tại ít nhất 1 ngày!");
            return;
        }

        redirectToRoomTypePage(selectedPerson, checkinDate, checkoutDate);
    });
});

function isValidCheckoutDate(checkinDate, checkoutDate) {
    var currentDate = new Date();
    var checkin = parseDate(checkinDate);
    var checkout = parseDate(checkoutDate);

    // Kiểm tra nếu ngày trả phòng không hợp lệ
    return checkout > currentDate && checkout > checkin;
}

function parseDate(dateString) {
    var parts = dateString.split("/");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function redirectToRoomTypePage(selectedPerson, checkinDate, checkoutDate) {
    window.location.href = "index.php?controller=client&action=roomSelection&checkin_date=" + checkinDate + "&checkout_date=" + checkoutDate + "&person=" + selectedPerson;
}

    </script>