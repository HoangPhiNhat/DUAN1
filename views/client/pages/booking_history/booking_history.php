<!-- Include your header and navigation if necessary -->




<div class="sign-in-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 ">
                <ul class="navbar-nav">
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php?controller=client&action=profile">Profile</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="index.php?controller=client&action=booking_history">Booking History</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10 left-sidebar">

                <div class="user-all-form">
                    <div class="contact-forms">
                        <div class="section-title text-center">
                            <span class="sp-color">Register</span>
                            <h2>Create an Account</h2>
                        </div>
                        <form action="/DUAN1/index.php?controller=client&action=register" method="POST" id="registerForm">
                            <!-- Your registration form fields go here -->

                            <div class="col-lg-12 col-md-12 text-center">
                                <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                    Register Now
                                </button>
                            </div>
                            <div class="col-12">
                                <p class="account-desc">
                                    Already a Member?
                                    <a href="index.php?controller=client&action=signIn">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Include your footer if necessary -->