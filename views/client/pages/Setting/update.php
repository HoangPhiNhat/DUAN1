<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_info = login::getUserInfoByID($_SESSION['user_id']);

?>


<div class="sign-in-area pt-100 pb-70">
    <div class="container">
        <div class="row" style="margin-top: 65px; ">
            <div class="col-lg-2 bg-light-gray left ">
                <ul class="navbar-nav">
                    <li class="nav-item" style="margin-top: 6px; border-bottom: 1px dashed #9b9b9b;">
                        <a class="nav-link" style="margin-left: 12px" href="index.php?controller=client&action=profile">Profile</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10 bg-light-gray border">
                <div class="user-all-form">
                    <div class="contact-forms text-left">
                        <div style="margin-top: -76px; border-bottom: 1px solid #b4b6b9;">
            <h3 style=" margin-left: 10px;">Update Profile</h3>
            </div>
            <form action="index.php?controller=client&action=update&id=<?php echo $_SESSION['user_id']; ?>" method="POST">
                <div class="row" style=" margin-left: 1px; margin-right: 6px; ">
                    <div class="form-group col-md-12">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user_info['name']; ?>" required>
                    </div>
                    <div class="form-group col-md-12">
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
                    <div class="form-group col-md-12" style="margin-top: 15px;">
                        <a href="index.php?controller=client&action=profile";></a><button type="submit" class="btn btn-primary">Cập Nhật</button>
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