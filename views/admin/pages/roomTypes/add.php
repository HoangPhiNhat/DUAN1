<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm loại phòng</h4>
            <form action="/DUAN1/index.php?controller=admin&action=addRoomType" method="POST" class="forms-sample" onsubmit="return validateFormSecond()">
                <div class="form-group">
                    <label for="name">Tên loại phòng</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên Cở Sở" oninput="validateInputSecond('name')">
                    <span id="nameError" style="color: red;"></span>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" oninput="validateInputSecond('description')">
                    <span id="descriptionError" style="color: red;"></span>
                </div>
                <button type="submit" name="submitUpdateFacility" class="btn btn-gradient-primary me-2" id="submitButton" disabled>Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=facilityList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>
