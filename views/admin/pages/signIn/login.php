<div class="sign-in-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="user-all-form">
                    <div class="contact-form">
                        <div class="section-title text-center">
                            <span class="sp-color">Sign In</span>
                            <h2>Sign In to Your Account!</h2>
                        </div>
                        <form action="/DUAN1/index.php?controller=client&action=signIn" method="POST" id="contactForm">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your Username or Email" placeholder="Username or Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <?php if (isset($error)) : ?>
                                    <p style="color: red;"><?php echo $error; ?></p>
                                <?php endif; ?>

                                <div class="col-lg-6 col-sm-6 form-condition">
                                    <div class="agree-label">
                                        <input type="checkbox" id="chb1">
                                        <label for="chb1">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <a class="forget" href="#">Forgot My Password?</a>
                                </div>
                                <div class="col-lg-12 col-md-12 text-center">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Sign In Now
                                    </button>
                                </div>
                                <div class="col-12">
                                    <p class="account-desc">
                                        Not a Member?
                                        <a href="index.php?controller=client&action=register">Sign Up</a>
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