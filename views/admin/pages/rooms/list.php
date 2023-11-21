<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách Phòng</h4>
                <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addRoom">
                        Thêm Phòng
                    </a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Tên Phòng </th>
                            <th> Giá Tiền Một Đêm </th>
                            <th> Số Lượng Người Một Phòng </th>
                            <th> Cơ Sở </th>
                            <th> Loại Phòng </th>
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
                                    <?php echo $value->price_per_night ?>
                                </td>
                                <td>
                                    <?php echo $value->capacity ?>
                                </td>
                                <td>
                                    <?php echo Facility::getNameById($value->facility_id); ?>
                                </td>
                                <td>
                                    <?php echo RoomType::getNameById($value->room_type_id); ?>
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