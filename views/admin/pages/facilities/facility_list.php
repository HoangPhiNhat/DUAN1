<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách danh mục</h4>
            <p class="card-description"> Add class <code>.table-bordered</code>
            </p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Tên </th>
                        <th> Email </th>
                        <th> Số điện thoại </th>
                        <th> Chất lượng </th>
                        <th> Địa chỉ </th>
                        <th> Ngày tạo </th>
                        <th> Ngày chỉnh sửa </th>
                        <th> Chức Năng </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listFacility as $value) :
                        extract($value) ?>
                    <tr>
                        <td><?php echo $id ?>
                        </td>
                        <td> <?php echo $name ?> </td>
                        <td> <?php echo $email ?> </td>
                        <td> <?php echo $phone_number ?> </td>
                        <td class="text-center"> <?php echo $starts ?><i class="mdi mdi-star-outline"></i></td>
                        <td> <?php echo $address ?> </td>
                        <td> <?php echo $created_date ?> </td>
                        <td> <?php echo $updated_date ?> </td>
                        <td style="display:flex;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;">
                            <button class="btn btn-gradient-primary" style="margin-bottom: 5px;"><a>Sửa</a></button>
                            <button class="btn btn-gradient-primary "><a
                                    href=<?php echo "index.php?act=delete_facility&id=".$id ?>>Xóa</a></button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>