<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body " style="border-bottom: 1px solid">
            <div class="page-header">
                <h4 class="card-title">Quyền</h4>
                <span>
                    <a class="nav-link" href="index.php?controller=admin&action=addroles">
                        Thêm Quyền
                    </a>
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Tên Quyền </th>
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
                                    <button class="btn btn-gradient-primary" style="margin-bottom: 5px;">
                                        <a href='<?php echo "index.php?controller=admin&action=findRoomType&id=$value->id" ?>' style="padding: 0; color: #fff;">
                                            Xóa
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body ">
            <div class="row ">
                <div class="col-md-2 admin-tab">
                    <h4 class="card-title switch-table " data-target="admin">Admin</h4>
                </div>
                <div class="col-md-2 user-tab">
                    <h4 class="card-title switch-table " data-target="user">User</h4>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="admin-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Vai Trò </th>
                            <th> Tên Người dùng </th>
                            <th> Email </th>
                            <th> SDT </th>
                            <th> Phân Quyền </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $value) : ?>
                            <?php if ($value->roles_id == 1) : ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo 'Admin'; ?></td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->email ?></td>
                                    <td><?php echo $value->phone_number ?></td>
                                    <td style="display:flex;
                        gap: 5px;
                        justify-content: center;
                        align-items: center;">
                                        <button class="btn btn-gradient-primary"><a href="<?php echo "index.php?controller=admin&action=findPermission&id=$value->id" ?>" style="padding: 0; color: #fff;" class="nav-link">Quyền</a></button>
                                        <button class="btn btn-gradient-primary "><a href=<?php echo "c" ?> style="padding: 0; color: #fff;" class="nav-link">Xóa</a></button>
                                    </td>
                                    <!-- Các cột khác nếu có -->
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table class="table table-bordered" id="user-table">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Vai Trò </th>
                            <th> Tên Người dùng </th>
                            <th> Email </th>
                            <th> SDT </th>
                            <th> Phân Quyền </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $value) : ?>
                            <?php if ($value->roles_id == 2) : ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <td><?php echo 'User'; ?></td>
                                    <td><?php echo $value->name ?></td>
                                    <td><?php echo $value->email ?></td>
                                    <td><?php echo $value->phone_number ?></td>
                                    <td style="display:flex;
                        gap: 5px;
                        justify-content: center;
                        align-items: center;">
                                        <button class="btn btn-gradient-primary"><a href="<?php echo "index.php?controller=admin&action=findPermission&id=$value->id" ?>" style="padding: 0; color: #fff;" class="nav-link">Quyền</a></button>
                                        <button class="btn btn-gradient-primary "><a href=<?php echo "c" ?> style="padding: 0; color: #fff;" class="nav-link">Xóa</a></button>
                                    </td>
                                    <!-- Các cột khác nếu có -->
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $(".switch-table").click(function() {
            var target = $(this).data("target");

            // Remove active class from all tabs and tables
            $(".switch-table, table").removeClass("active");

            // Add active class to the clicked tab and corresponding table
            $(this).addClass("active");
            $("#" + target + "-table").addClass("active");

            // Show/hide tables based on the selected tab
            if (target === "admin") {
                $("#admin-table").show();
                $("#user-table").hide();
            } else if (target === "user") {
                $("#admin-table").hide();
                $("#user-table").show();
            }
        });
    });
</script>
<style>
    .admin-tab {
        /* background-color: #3498db; Customize the background color for the Admin tab */
        color: #ffffff;
        /* Customize the text color for the Admin tab */
        text-align: center;
        color: #ffffff;
        text-align: center;
        margin-left: 2px;

    }

    .user-tab {
        /* background-color: #2ecc71; Customize the background color for the User tab */
        color: #ffffff;
        /* Customize the text color for the User tab */
        text-align: center;
        color: #ffffff;
        text-align: center;
        left: -45px;
    }

    .switch-table.active {
        background-color: #ccc;
        color: #000000;
        height: 32px;
        margin-bottom: 0px;
        border-radius: 5px 5px 0px 0px;
        text-align: center;
        padding: 6px;

    }
/* 
    table.active {
        background-color: #ccc;
    } */
</style>