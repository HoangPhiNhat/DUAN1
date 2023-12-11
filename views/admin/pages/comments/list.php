<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách Bình Luận</h4>
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
                            <th> Tên phòng bình luận </th>
                            <th> Tên Người dùng </th>
                            <th> Nội dung </th>
                            <th> Đánh Giá </th>
                            <th> Ngày Bình luận </th>
                            <th> Chức Năng </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $value) :
                        ?>
                            <tr>
                                <td>
                                    <?php echo $value->comment_id ?>
                                </td>
                                <td>
                                    <?php echo Rooms::getNameById($value->room_id); ?>
                                </td>
                                <td>
                                    <?php echo login::getNameById($value->customer_id); ?>
                                </td>
                                <td class="text-truncate" style="max-width: 250px; white-space: pre-line;" title="<?php echo $value->comment_text ?>">
                                    <?php echo $value->comment_text ?>
                                </td>
                                <td>
                                    <span style="color: #ef760b;"><?php echo Comment::displayStarRating($value->rating); ?></span>
                                </td>
                                <td>
                                    <?php echo $value->created_at ?>
                                </td>
                                <td>
                                    <form method="POST" action="index.php?controller=admin&action=deleteComment&id=<?php echo $value->comment_id; ?>">
                                        <button type="submit" class="btn btn-gradient-primary" style="margin-bottom: 5px;">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>