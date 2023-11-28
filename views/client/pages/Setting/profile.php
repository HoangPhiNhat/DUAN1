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
            <div class="col-lg-2 ">
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
    <h1 class="text-center" style="margin-top: -65px;">Welcome_Profile</h1>
    <form action="index.php?controller=client&action=update&id=<?php echo $_SESSION['user_id']; ?>" method="POST" class="forms-sample" style="width: 50%; margin: 0 auto;">
        <div class="form-group">
            <label for="name">Tên :</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_info['name']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $user_info['email']; ?>">
        </div>
        <div class="form-group">
            <label for="phone_number">Số Điện Thoại:</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user_info['phone_number']; ?>">
        </div>
      
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user_info['address']; ?>">
        </div>
        <div style="margin-top: 15px; width: 186px; margin-left: 144px; padding: 5px; background-color: #007BFF; border: 1px solid #007BFF; border-radius: 5px;">
            <button class="btn btn-gradient-primary" style="width: 100%;">Cập Nhật Tài Khoản</button>
        </div>
    </form>
</div>



                </div>
            </div>

        </div>
    </div>
</div>



<!-- Include your footer if necessary -->