

<?php
$controllers = array(

    'client' => ['home', 'aboutUs', 'bookNow', 'register', 'signIn', 'error','Contact','rooms','room_details','roomDetails','logOut',
<<<<<<< HEAD
    'booking_history','profile','getUserInfoByID','update','findProfile','addComment','findComments',  'roomSelection', 'secureBooking','displayReservationsForCustomer', 'redirect'],
=======
    'booking_history','profile','getUserInfoByID','update','findProfile','addComment','findComments',  'roomSelection', 'secureBooking','displayReservationsForCustomer',
    'roomSame','roomAvailabilityAction'],
>>>>>>> 7ef0b9ca23bb021be35679b61df42ab1ccc62a98

    // 'client' => ['home', 'aboutUs', 'bookNow', 'register', 'signIn', 'error','Contact','rooms',
    // 'room_details','logOut', 'roomSelection', 'secureBooking' ],

    'admin' => ['dashboard', 'facilityList', 'addFacility', 'findFacility', 'updateFacility',
    'roomList', 'addRoom', 'showRoomsAndFacilities','customersList',
    'roomTypeList', 'findRoomType', 'updateRoomType', 'addRoomType','commentsList' ,'deleteComment',
    'ReservationsList','updateReservations','findReservations']
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'client';

    $action = 'error';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . '_controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();
