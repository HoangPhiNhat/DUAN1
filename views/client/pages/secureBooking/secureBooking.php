<?php
$serviceCharge = 109.918;
$VAT = 271.204;
$priceString = $_GET['price'];
$checkinDateString = $_GET['checkin_date'];
$checkoutDateString = $_GET['checkout_date'];
$price = intval(str_replace('.', '', $priceString));
$checkinDate = DateTime::createFromFormat('d/m/Y', $checkinDateString);
$checkoutDate = DateTime::createFromFormat('d/m/Y', $checkoutDateString);

$numberOfNights = $checkinDate->diff($checkoutDate)->days;
$totalPrice = $price * $numberOfNights + intval(str_replace('.', '', $serviceCharge))  + intval(str_replace('.', '', $VAT));

$formattedPrice = number_format($totalPrice, 0, ',', '.');

?>


<div class="inner-banner inner-bg7">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Trang chủ</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Thủ tục thanh toán</li>
            </ul>
            <h3>Thủ tục thanh toán</h3>
        </div>
    </div>
</div>
<section class="checkout-area pt-100 pb-70">
    <div class="container">
    <form id="paymentForm" action="./vnpay_php/vnpay_create_payment.php" method="post" onsubmit="return prepareAndRedirect()">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="billing-details">
                        <h3 class="title">Thông tin khách sạn</h3>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div id="fb-recap-hotel" class="col-xs-12 fb-gray-bg">
                                    <div id="fb-recap-hotel-details">
                                        <dl class="col-xs-12 dl-horizontal">
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Địa chỉ
                                                </dt>
                                                <dd>
                                                    D8 Giảng Võ, Quận Ba Đình, Hà Nội, Việt Nam, 10000, Hà Nội, Việt Nam
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Lễ tân mở
                                                </dt>
                                                <dd>
                                                    Hoạt động 24/24
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Nhận phòng từ

                                                <dd>
                                                    <span class="fb-time">
                                                        2:00 CH
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Trả phòng trước
                                                </dt>
                                                <dd>
                                                    <span class="fb-time" data-value="12:00">
                                                        12:00 CH
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Ngôn ngữ sử dụng
                                                </dt>
                                                <dd>Tiếng Anh, Tiếng Việt</dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Liên hệ
                                                </dt>
                                                <dd>8424-3-845 2270</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div id="fb-recap-hotel" class="col-xs-12 fb-gray-bg">
                                    <div id="fb-recap-hotel-details">
                                        <h3>Thông tin đặt phòng</h3>
                                        <dl class="col-xs-12 dl-horizontal">
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Loại phòng
                                                </dt>
                                                <dd>
                                                    <?php echo RoomType::getNameById($room->room_type_id); ?>
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Nhận phòng
                                                </dt>
                                                <dd>
                                                    <?php echo $checkinDateString  ?>
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Trả phòng
                                                </dt>
                                                <dd>
                                                    <span class="fb-time">
                                                        <?php echo $checkoutDateString  ?>
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Giá phòng
                                                </dt>
                                                <dd>
                                                    <span class="fb-time" data-value="12:00">
                                                        <?php echo $priceString ?> ₫
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    <span>
                                                        Phí dịch vụ
                                                </dt>
                                                <dd>
                                                    <?php echo $serviceCharge ?> ₫
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                    Thuế VAT
                                                </dt>
                                                <dd>
                                                <?php echo $VAT ?> ₫
                                                </dd>
                                            </div>
                                            <div class="infoHotel">
                                                <dt class="fb-dark-gray">
                                                   Tổng
                                                </dt>
                                                <dd >
                                               <p name="amount" value="<?php echo $totalPrice ?>"><?php echo $formattedPrice ?> ₫</p>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <h3>Thông tin khách hàng</h3>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label name="customer" value="<?php echo $InfoUser['id'] ?>">Họ và tên<span class="required">*</label>
                                    <input type="text" class="form-control" required value="<?php echo $InfoUser['name'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Điện thoại <span class="required">*</label>
                                    <input type="text" class="form-control" required value="<?php echo $InfoUser['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Địa chỉ email <span class="required">*</label>
                                    <input type="email" class="form-control" required value="<?php echo $InfoUser['email'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="payment-box">
                                    <div class="payment-method">
                                        <!-- <p>
                                            <input type="radio" id="direct-bank-transfer" name="radio-group" checked="">
                                            <label for="direct-bank-transfer">Chuyển khoản trực tiếp</label>
                                            Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi.
                                            Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán.
                                            Đơn đặt hàng của bạn sẽ không được vận chuyển cho đến khi tiền đã được xóa trong tài khoản của chúng tôi.
                                        </p>
                                        <p>
                                            <input type="radio" id="paypal" name="radio-group">
                                            <label for="paypal">PayPal</label>
                                        </p> -->
                                        <input type="hidden" name="language" value="BIDV">

                                        <p>
                                            <input type="radio" id="cash-on-delivery" name="bankCode" value="Thanh toán VNPAY">
                                            <label for="cash-on-delivery">Thanh toán VNPAY</label>
                                        </p>
                                    </div>
                                    <button type="submit" class="order-btn three" name="redirect">
                                        Đặt phòng
                                    </button>
                                </div>
                            </div>
                        </div>
        </form>
    </div>
</section>
<script>
    function prepareAndRedirect() {
        // Lấy giá trị từ các trường form
        var invMobile = document.getElementById("txt_inv_mobile").value;
        var invEmail = document.getElementById("txt_inv_email").value;
        // Lấy các giá trị khác nếu cần thiết

        // Xử lý dữ liệu nếu cần
        // ...

        // Tạo URL thanh toán với dữ liệu từ form
        var paymentUrl = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html?";
        paymentUrl += "vnp_Amount=100000&"; // Thay thế bằng cách lấy giá trị thực tế từ form
        paymentUrl += "vnp_BankCode=BIDV&"; // Thay thế bằng cách lấy giá trị thực tế từ form
        // Thêm các tham số khác từ dữ liệu form

        // Chuyển hướng người dùng đến trang thanh toán
        window.location.href = paymentUrl;

        // Ngăn chặn form submit mặc định
        return false;
    }
</script>