<div class="inner-banner inner-bg5">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Booking</li>
            </ul>
            <h3>Booking</h3>
        </div>
    </div>
</div>

<div class="book-area pt-100 pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="book-img">
                    <img src="assets/img/book-img.jpg" alt="Images">
                    <div class="book-shape">
                        <img src="assets/img/shape/shape1.png" alt>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="booking-form">
                    <h3>Booking Sheet </h3>
                    <form>
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Your Name</label>
                                    <input type="text" name="name" class="form-control" required data-error="Please enter your name" placeholder="Your Name">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Your Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Your Email">
                                    <i class="bx bx-mail-send"></i>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Check in</label>
                                    <div class="input-group date">
                                        <input id="checkInDatePicker" type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Check Out</label>
                                    <div class="input-group">
                                        <input id="checkOutDatePicker" type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Numbers of Persons</label>
                                    <select class="form-control">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Numbers of Rooms</label>
                                    <select class="form-control">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn btn-bg-two border-radius-5">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="views/client/pages/bookingRoom/book.js"></script>