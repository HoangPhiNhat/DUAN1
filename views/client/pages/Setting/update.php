<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_info = login::getUserInfoByID($_SESSION['user_id']);

?>


<div class="sign-in-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 " style="margin-top: 15px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=client&action=profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=client&action=booking_history">Booking History</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10 left-sidebar">
    <div class="user-all-form">
        <div class="contact-forms text-center">
            <h2>Update Profile</h2>
            <form action="index.php?controller=client&action=update&id=<?php echo $_SESSION['user_id']; ?>" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user_info['name']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone_number">Số Điện Thoại:</label>
                        <input type="text" name="phone_number" class="form-control" value="<?php echo $user_info['phone_number']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $user_info['email']; ?>" required>
                    </div>

                    

                    <div class="form-group col-md-12">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $user_info['address']; ?>">
                    </div>
<!-- 
                    <div class="form-group col-md-6">
                        <label for="new_password">Mật khẩu mới:</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="roles_id">Quyền:</label>
                        <select name="roles_id" class="form-control">
                            <option value="1" <?php if ($user_info['roles_id'] == 1) echo 'selected'; ?>>Quyền 1</option>
                            <option value="2" <?php if ($user_info['roles_id'] == 2) echo 'selected'; ?>>Quyền 2</option>
                        </select>
                    </div> -->

                    <div class="form-group col-md-12" style="margin-top: 15px;">
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



        </div>
    </div>
</div>



<!-- Include your footer if necessary -->