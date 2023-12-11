<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body ">
            <div class="page-header">
                <h4 class="card-title">Danh sách Đơn Đặt Phòng</h4>
                <!-- <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addRoom">
                        Thêm Phòng
                    </a>
                </span> -->
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Chức Năng </th>
                            <th> Trạng thái</th>
                            <th> ID </th>
                            <th> Tên Người Đặt </th>
                            <th> SDT </th>
                            <th> Địa chỉ </th>
                            <th> Tên Phòng </th>
                            <th> Checkin </th>
                            <th> Checkout </th>
                            <th> Tổng Tiền </th>
                            <th> Ngày tạo </th>
                            <th> Ngày chỉnh sửa </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lists as $value) :
                        ?>
                            <tr>
                                <td style="display:flex;
                                    flex-wrap: wrap;
                                    justify-content: center;
                                    align-items: center;">
                                    <button class="btn btn-gradient-primary" style="margin-bottom: 5px;"><a href="<?php echo "index.php?controller=admin&action=findReservations&id=$value->id" ?>" style="padding: 0; color: #fff;" class="nav-link">Cập Nhật</a></button>
                                    <!-- <button class="btn btn-gradient-primary "><a href=<?php echo "c" ?> style="padding: 0; color: #fff;" class="nav-link">Xóa</a></button> -->
                                </td>
                                <td>
                                    <?php echo $value->status ?>
                                </td>

                                <td>
                                    <?php echo $value->id ?>
                                </td>
                                <td>
                                    <!-- <?php echo $value->customer_id ?> -->
                                    <?php echo login::getNameById($value->customer_id); ?>

                                </td>
                                <td>
                                    <!-- <?php echo $value->customer_id ?> -->
                                    <?php echo login::getPhoneById($value->customer_id); ?>

                                </td>
                                <td>
                                    <!-- <?php echo $value->customer_id ?> -->
                                    <?php echo login::getAddressById($value->customer_id); ?>

                                </td>
                                <td>
                                    <!-- <?php echo $value->room_id ?> -->
                                    <?php echo Rooms::getNameById($value->room_id); ?>
                                </td>
                                <td>
                                    <?php echo $value->checkin_date ?>
                                </td>
                                <td>
                                    <?php echo $value->checkout_date ?>
                                </td>
                                <td>
                                    <?php
                                    $amountString = $value->total_amount;
                                    $amount = (float) str_replace(['VND', ','], ['', ''], $amountString);
                                    $formattedAmount = number_format($amount, 0, ',', '.');
                                    echo $formattedAmount . 'VND';
                                    ?>
                                </td>
                                <td>
                                    <?php echo $value->created_date ?>
                                </td>
                                <td>
                                    <?php echo $value->updated_date ?>
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