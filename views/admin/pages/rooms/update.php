<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Phòng</h4>
            <form action="/DUAN1/index.php?controller=admin&action=updateRoom" method="POST" class="forms-sample">
                <div class="form-group">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id : ''; ?>">
                    <label for="roomsName">Tên Phòng</label>
                    <input type="text" class="form-control" id="roomsName" name="name" placeholder="Tên Phòng" value="<?php echo $value->name ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="price_per_night">Giá Tiền Một Đêm</label>
                    <input type="price_per_night" class="form-control" id="price_per_night" name="price_per_night" placeholder="Giá Tiền" value="<?php echo $value->price_per_night ?>">
                </div>
                <div class="form-group">
                    <label for="capacity">Số Lượng Người Một Phòng</label>
                    <input type="tel" class="form-control" id="	capacity" name="capacity" placeholder="Số Người" value="<?php echo $value->capacity ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="facility_id">Cơ Sở</label>
                    <input type="facility_id" class="form-control" id="facility_id" name="facility_id" placeholder="Cơ Sở" value="<?php echo Facility::getNameById($value->facility_id); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="room_type_id">Loại Phòng</label>
                    <input type="room_type_id" class="form-control" id="room_type_id" name="room_type_id" placeholder="Loại Phòng" value="<?php echo RoomType::getNameById($value->room_type_id); ?>" readonly>
                </div>
                <!-- <div class="form-group">
                <label>Hình ảnh</label>
                <span class="input-group-append custom_image">
                <button name="image_path id="uploadImage" class="btn btn-upload" type="button" style="border: 2px dashed #d9d9d9; padding: 38px 21px;" >
                <input type="file" name="image_path" readonly>
                </button>
                </span>
                </div> -->
               
                <button type="submit" name="submitAddFacility" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=roomList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>