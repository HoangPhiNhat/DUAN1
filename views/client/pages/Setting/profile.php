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
                        <div style="margin-top: -65px; border-bottom: 1px solid #b4b6b9;">
                        <h5 style="margin-left: 20px;">Thông Tin Tài Khoản</h5>
                        </div>
                        <form action="index.php?controller=client&action=update&id=<?php echo $_SESSION['user_id']; ?>" method="POST" class="forms-sample">
                            <div class="form-group" style="margin-left: 20px; margin-right: 20px;">
                                <h7 for="name">Tên </h7>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_info['name']; ?>">
                            </div>
                            <div class="form-group" style="margin-left: 20px; margin-right: 20px;">
                                <h7 for="email">Email</h7>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_info['email']; ?>">
                            </div>
                            <div class="form-group" style="margin-left: 20px; margin-right: 20px;">
                                <h7 for="phone_number">Số Điện Thoại</h7>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user_info['phone_number']; ?>">
                            </div>
                            <div class="form-group" style="margin-left: 20px; margin-right: 20px;">
                                <h7 for="address">Địa chỉ</h7>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_info['address']; ?>">
                            </div>
                            <div style="margin-top: 25px; width: 30%;margin-left: 30px;">
                                <button class="btn btn-primary btn-lg btn-block">Cập Nhật Tài Khoản</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>