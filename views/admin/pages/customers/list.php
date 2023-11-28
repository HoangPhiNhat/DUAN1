<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách Người Dùng</h4>
                <!-- <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addRoomType">
                        Thêm loại phòng
                    </a>
                </span> -->
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Tên Người dùng </th>
                            <th> Email </th>
                            <th> SDT </th>
                            <th> Địa Chỉ </th>
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
                                    <!-- <?php echo Rooms::getNameById($value->room_id); ?> -->
                                    <?php echo $value->name ?>
                                </td>
                                <td>
                                    <!-- <?php echo login::getNameById($value->customer_id); ?> -->
                                    <?php echo $value->email ?>
                                </td>
                                <td>
                                    <?php echo $value->phone_number ?>
                                </td>

                                <td>
                                <?php echo $value->gender ?>
                                </td>
                                <!-- <td>
                                    <form method="POST" action="index.php?controller=admin&action=deleteComment&id=<?php echo $value->comment_id; ?>">
                                        <button type="submit" class="btn btn-gradient-primary" style="margin-bottom: 5px;">
                                            Xóa
                                        </button>
                                    </form>
                                </td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>