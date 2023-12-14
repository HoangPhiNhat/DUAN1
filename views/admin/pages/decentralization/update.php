<div class="col-12 grid-margin stretch-card h-100">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Phân Quyền</h4>
            <form action="/DUAN1/index.php?controller=admin&action=updatePermission" method="POST" class="forms-sample">
                <input type="hidden" name="id" value="<?php echo $value->id; ?>">

                <div class="form-group">
                    <label for="name">Tên Tài Khoản</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên Tài Khoản" readonly value="<?php echo $value->name; ?>">
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" class="form-control" id="Email" name="Email" placeholder="Nhập Email" readonly value="<?php echo $value->email; ?>">
                </div>

                <div class="form-group">
                    <label for="description">SĐT</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" readonly value="<?php echo $value->phone_number; ?>">
                </div>
                <?php var_dump($roles) ?>

                <div class="form-group">
                    <label for="roles">Vai Trò</label>
                    <select class="form-control" id="roles" name="roles_id">
                        <?php foreach ($roles as $role) :
                        ?>
                            <option value="<?php echo $role->id; ?>" <?php echo ($role->id == $value->roles_id) ? 'selected' : ''; ?>>
                                <?php echo $role->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="submitUpdatePermission" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">
                    <a href="index.php?controller=admin&action=roomTypeList">Cancel</a>
                </button>
            </form>
        </div>
    </div>
</div>