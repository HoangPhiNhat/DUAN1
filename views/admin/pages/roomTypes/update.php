<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa loại phòng</h4>
            <form action="/DUAN1/index.php?controller=admin&action=updateRoomType" method="POST" class="forms-sample">
                <div class="form-group">
                <input type="hidden" name="id" value="<?php echo isset($value->id) ? $value->id : ''; ?>">
                    <label for="name">Tên loại phòng</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên Cở Sở" value="<?php echo $value->name ?>">
                </div>
                <div class="form-group">
                    <label for="description"> Mô tả </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" value="<?php echo $value->description ?>">
                </div>
                <button type="submit" name="submitUpdateRoomType" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=roomTypeList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>