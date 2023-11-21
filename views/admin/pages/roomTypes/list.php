<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách loại phòng</h4>
                <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addRoomType">
                        Thêm loại phòng
                    </a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Loại phòng </th>
                            <th> Mô tả </th>
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
                                <td class="text-truncate" style="max-width: 150px;" title="<?php echo $value->description ?>">
                                    <?php echo $value->description ?>
                                </td>
                                <td>
                                    <?php echo $value->created_date ?>
                                </td>
                                <td>
                                    <?php echo $value->updated_date ?>
                                </td>
                                <td>
                                    <button class="btn btn-gradient-primary" style="margin-bottom: 5px;">
                                            <a href='<?php echo "index.php?controller=admin&action=findRoomType&id=$value->id"?>' style="padding: 0; color: #fff;" >
                                                Sửa
                                            </a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>