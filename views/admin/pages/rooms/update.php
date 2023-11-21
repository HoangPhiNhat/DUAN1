<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Phòng</h4>
            <form action="/DUAN1/index.php?controller=admin&action=addRooms" method="POST" class="forms-sample">
                <div class="form-group">
                    <label for="roomsName">Tên Phòng</label>
                    <input type="text" class="form-control" id="roomsName" name="name" placeholder="Tên Cở Sở">
                </div>
                <div class="form-group">
                    <label for="roomsEmail">Giá Tiền Một Đêm</label>
                    <input type="Email" class="form-control" id="roomsEmail" name="email" placeholder="Địa chỉ Email">
                </div>
                <div class="form-group">
                    <label for="roomsPhone">Số Lượng Người Một Phòng</label>
                    <input type="tel" class="form-control" id="roomsPhone" name="phone_number" placeholder="Số điện thoại">
                </div>
               
                <button type="submit" name="submitAddFacility" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=facilityList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>