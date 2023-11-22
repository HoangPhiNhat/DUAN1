<div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Sign Up</li>
            </ul>
            <h3>Sign Up</h3>
        </div>
    </div>
</div>


<div class="sign-up-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-all-form">
                    <div class="contact-form">
                        <div class="section-title text-center">
                            <span class="sp-color">Sign Up</span>
                            <h2>Create an Account!</h2>
                        </div>
                        <form action="/DUAN1/index.php?controller=client&action=register" method="POST" id="contactForm" novalidate="true" class="">
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required="" data-error="Vui lòng nhập họ tên đầy đủ" placeholder="Họ và tên">
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter email" placeholder="Email">
                                        <span id="emailError" style="color: red;"></span>
                                        <?php if (isset($error)) : ?>
                                            <p style="color: red;"><?php echo $error; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Mật khẩu">
                                        <span id="passwordError" style="color: red;"></span>

                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group">
                                        <input class="form-control" type="password" id="ConfirmPassword" name="password" placeholder="Nhập lại mật khẩu">
                                        <span id="confirmPasswordError" style="color: red;"></span>

                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Sign Up
                                    </button>
                                </div>
                                <div class="col-12">
                                    <p class="account-desc">
                                        Already have an account?
                                        <a href="index.php?controller=client&action=signIn">Sign In</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="views/client/pages/register/register.js"></script>