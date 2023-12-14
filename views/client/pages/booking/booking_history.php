<!-- Include your header and navigation if necessary -->
<div class="container">
    <div>
        <h2 class="card-title" style="padding: 10px;margin-top: 65px;background-color: rgba(0, 0, 0, .03);border: 1px solid #ccc; border-radius: 5px;">Thông Tin Đặt Phòng</h2>
    </div>
    <?php if (!empty($bookingHistory)) : ?>
        <?php foreach ($bookingHistory as $booking) : ?>

            <div class="card mb-3">

                <div class="card-header">
                    <h5 class="card-title">Hóa Đơn #<?php echo $booking['id']; ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-subtitle mb-2 text-muted">Tên Người Đặt</h6>
                            <p class="card-text"><?php echo isset($booking['customer_id']) ? roomReservation::getNameById($booking['customer_id']) : ''; ?></p>

                            <h6 class="card-subtitle mb-2 text-muted">Email</h6>
                            <p class="card-text"><?php echo isset($booking['customer_id']) ? roomReservation::getEmailById($booking['customer_id']) : ''; ?></p>

                            <h6 class="card-subtitle mb-2 text-muted">Số Điện thoại</h6>
                            <p class="card-text"><?php echo isset($booking['customer_id']) ? roomReservation::getPhoneById($booking['customer_id']) : ''; ?></p>
                            <h6 class="card-subtitle mb-2 text-muted">Địa Chỉ</h6>
                            <p class="card-text"><?php echo isset($booking['customer_id']) ? roomReservation::getAddressById($booking['customer_id']) : ''; ?></p>

                        </div>
                        <div class="col-md-6">
                            <h6 class="card-subtitle mb-2 text-muted">Loại Phòng Đặt</h6>
                            <p class="card-text"><?php echo isset($booking['room_id']) ? Rooms::getNameById($booking['room_id']) : ''; ?></p>
                            <h6 class="card-subtitle mb-2 text-muted">Giá Tiền</h6>
                            <p class="card-text"><?php echo number_format($booking['total_amount'], 0, ',', '.'); ?> VND</p>

                            <h6 class="card-subtitle mb-2 text-muted">Thời Gian Đặt Phòng</h6>
                            <p class="card-text">Checkin: <?php echo $booking['checkin_date']; ?> - Checkout: <?php echo $booking['checkout_date']; ?></p>

                            <h6 class="card-subtitle mb-2 text-muted">Trạng Thái</h6>
                            <p class="card-text"><?php echo $booking['status']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="alert alert-info">Không có lịch sử đặt phòng.</p>
    <?php endif; ?>
</div>