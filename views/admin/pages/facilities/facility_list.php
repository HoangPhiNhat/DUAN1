<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách cơ sở</h4>
                <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addFacility">
                        Thêm cơ sở
                    </a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Tên cở sở </th>
                            <th> Email </th>
                            <th> Số điện thoại </th>
                            <th> Chất lượng </th>
                            <th> Mô tả </th>
                            <th> Địa chỉ </th>
                            <th> Ngày tạo </th>
                            <th> Ngày chỉnh sửa </th>
                            <th> Chức Năng </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $value) :
                        ?>
                            <tr>
                                <td>
                                    <?php echo $value->id ?>
                                </td>
                                <td>
                                    <?php echo $value->name ?>
                                </td>
                                <td>
                                    <?php echo $value->email ?>
                                </td>
                                <td>
                                    <?php echo $value->phone_number ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value->starts ?><i class="mdi mdi-star-outline"></i>
                                </td>

                                <td class="text-truncate" style="max-width: 150px;" title="<?php echo $value->description ?>">
                                    <?php echo $value->description ?>
                                </td>
                                <td class="text-truncate" style="max-width: 150px;" title="<?php echo $value->address ?>">
                                   <?php echo $value->address ?>
                                </td>
                                <td>
                                    <?php echo $value->created_date ?>
                                </td>
                                <td>
                                    <?php echo $value->updated_date ?>
                                </td>
                                <td style="display:flex;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;">
                                    <button class="btn btn-gradient-primary" style="margin-bottom: 5px;"><a style="padding: 0; color: #fff;" class="nav-link">Sửa</a></button>
                                    <button class="btn btn-gradient-primary "><a href=<?php echo "c" ?> style="padding: 0; color: #fff;" class="nav-link">Xóa</a></button>
                                </td>
                            </tr>
                        <?php endforeach
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>