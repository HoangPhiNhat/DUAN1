<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Trạng thái</h4>
            <form action="/DUAN1/index.php?controller=admin&action=updateReservations" method="POST" class="forms-sample">
                <div class="form-group">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id : ''; ?>">
                <label for="customer_id">Tên Người Đặt</label>
                    <input type="text" class="form-control" id="customer_id" name="customer_id" placeholder="Nhập Tên người đặt" value=" <?php echo $value->customer_id ?>" readonly>
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="room_id">Tên phòng</label>
                    <input type="text" class="form-control" id="room_id" name="room_id" placeholder="Nhập Tên phòng" value="<?php echo $value->room_id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="total_amount">Tổng Tiền</label>
                    <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="Nhập mô tả" value="<?php echo $value->total_amount ?>" readonly>
                </div>
                <div>
    <label>Trạng thái</label>
    <div>
    <input type="radio" id="confirmedStatus" name="status" value="confirmed">
        <label for="confirmedStatus">Chờ Xác Nhận</label>
        <input type="radio" id="confirmedStatus" name="status" value="confirmed">
        <label for="confirmedStatus">Đã Xác Nhận</label>
    
        <input type="radio" id="preparingStatus" name="status" value="preparing">
        <label for="preparingStatus">Phòng Đang được chuẩn bị</label>
    
        <input type="radio" id="preparedStatus" name="status" value="prepared">
        <label for="preparedStatus">Phòng Đã chuẩn bị song</label>
    </div>
</div>
                
                <button type="submit" name="submitupdateReservations" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=ReservationsList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>