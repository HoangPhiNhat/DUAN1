<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phòng</h4>
            <form action="/DUAN1/index.php?controller=admin&action=addRoom" method="POST" class="forms-sample">
                <div class="form-group">
                    <label for="Name">Tên Phòng</label>
                    <input type="text" class="form-control" id="Name" name="name" placeholder="Nhập tên phòng">
                    <span id="nameError" style="color: red;"></span>
                </div>
                <div class="form-group">
                    <label for="pricePerNight">Giá</label>
                    <input type="text" class="form-control" id="pricePerNight" name="price_per_night" placeholder="Nhập Giá">
                    <span id="pricePerNightError" style="color: red;"></span>
                </div>
                <div class="form-group">
                    <label for="capacity">Số lượng người trong một phòng</label>
                    <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Tối đa 4 người / phòng">
                    <span id="capacityError" style="color: red;"></span>
                </div>
                <!-- Hiển thị thông tin từ bảng roomType -->
                <div class="form-group">
                    <label for="roomTypeSelect">Loại phòng</label>
                    <select id="roomTypeSelect" name="room_type_id">
                        <option value="2" selected disabled>Tất cả</option>
                        <?php foreach ($roomType as $value) : ?>
                            <option value="<?= $value->id ?>"><?= $value->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="roomTypeError" style="color: red;"></span>
                </div>
                <!-- Hiển thị thông tin từ bảng facilities -->
                <div class="form-group">
                    <label for="facilitySelect">Cơ Sở</label>
                    <select id="facilitySelect" name="facility_id">
                        <option value="0" selected disabled>Tất cả</option>
                        <?php foreach ($facility as $value) : ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span id="facilityError" style="color: red;"></span>
                </div>

                <button type="submit" name="submitButton" class="btn btn-gradient-primary me-2" id="submitButton" disabled>Submit</button>
                <a href="index.php?controller=admin&action=roomsList">
                    Hủy
                </a>
            </form>
        </div>
    </div>
</div>
