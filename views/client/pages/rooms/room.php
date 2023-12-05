<div class="preloader">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="sk-cube-area">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
    </div>
</div>

<div class="inner-banner inner-bg9">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class="bx bx-chevron-right"></i></li>
                <li>Rooms</li>
            </ul>
            <h3>Rooms</h3>
        </div>
    </div>
</div>

<div class="room-area pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms &amp; Rates</h2>
        </div>
        <div class="row pt-45">
            <?php
            $displayedTypes = array();

            foreach ($lists as $value) :
                $roomTypeId = $value->room_type_id;
                if (!in_array($roomTypeId, $displayedTypes)) :
            ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="room-card">
                            <a href="room-details.html">
                                <img src="<?php echo "./uploads/" . $value->image_path ?>" alt="Images">
                            </a>
                            <div class="content">
                                <h3><a href="index.php?controller=client&action=room_details&id=<?= $value->id ?>"><?php echo RoomType::getNameById($value->room_type_id);  ?></a></h3>
                                <ul>
                                    <li class="text-color"><?php echo $value->price_per_night ?></li>
                                    <li class="text-color">Per Night</li>
                                </ul>
                                <div class="rating text-color">
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star-half"></i>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    $displayedTypes[] = $roomTypeId;
                endif;
            endforeach;
            ?>
        </div>
    </div>
</div>