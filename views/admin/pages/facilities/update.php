<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Cơ sở</h4>
            <form action="/DUAN1/index.php?controller=admin&action=updateFacility" method="POST" class="forms-sample">
                <div class="form-group">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id : ''; ?>">
                    <label for="facilityName">Tên Cơ Sở</label>
                    <input type="text" class="form-control" id="facilityName" name="name" placeholder="Tên Cở Sở" value="<?php echo $value->name ?>">
                </div>
                <div class="form-group">
                    <label for="facilityEmail">Email</label>
                    <input type="Email" class="form-control" id="facilityEmail" name="email" placeholder="Địa chỉ Email" value="<?php echo $value->email ?>">
                </div>
                <div class="form-group">
                    <label for="facilityPhone">Số điện thoại</label>
                    <input type="tel" class="form-control" id="facilityPhone" name="phone_number" placeholder="Số điện thoại" value="<?php echo $value->phone_number ?>">
                </div>
                <div class="form-group">
                    <label for="facilityRank">Xếp loại</label>
                    <input type="text" class="form-control" id="facilityRank" name="starts" placeholder="VD: 4 sao" value="<?php echo $value->starts ?>">
                </div>
                <div class="form-group">
                    <label for="facilityDescription">Mô tả</label>
                    <input type="text" class="form-control" id="facilityDescription" name="description" placeholder="Nhập mô tả" value="<?php echo $value->description ?>">
                </div>
                <div class="form-group">
                    <label for="facilityAddress">Địa chỉ</label>
                    <input type="text" class="form-control" id="facilityAddress" name="address" placeholder="Nhập địa chỉ" value="<?php echo $value->address ?>">
                </div>
                <!-- <div class="form-group">
                    <label>Hình ảnh</label>
                    <input type="file" name="img[]" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <span class="input-group-append custom_image">
                            <div id="imageOverlay" class="image-overlay">
                                <img id="overlayImage" src="" alt="Full Image Preview" class="overlay-image">
                                <button id="deleteImage" class="delete-button">Delete</button>
                            </div>

                            <div id="img-previews"></div>
                            <input style="display: none" type="file" class="form-control-file" id="imageInput"
                                name="imageInput" accept="image/*">
                            <button id="uploadImage" class="btn btn-upload" type="button">+ Upload</button>
                        </span>

                    </div>
                </div> -->
                <button type="submit" name="submitUpdateFacility" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=facilityList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>