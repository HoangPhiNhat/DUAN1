<?php session_start();

require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
require_once("models/admin/rooms/rooms.php");
require_once("models/admin/roomTypes/roomType.php");
require_once("models/admin/roles/roles.php");
require_once("models/client/account/register.php");
require_once("models/client/account/login.php");
require_once("models/client/comment/comment.php");
require_once("models/client/booking/booking.php");
require_once("models/client/booking/secureBooking.php");
require_once("models/admin/roomReservations/roomReservations.php");


class ClientController extends BaseController
{
    function __construct()
    {
        $this->parentFolder = 'client';
        $this->subFolder = 'pages';
    }

    public function home()
    {
        $lists = Rooms::getAllData();
        $list = Facility::getAllData();
        $data = array('lists' => $lists, 'list' => $list);
        $this->folder = 'home';
        $this->render('index', $data);
    }



    public function aboutUs()
    {
        $this->folder = 'aboutUs';
        $this->render('about');
    }
    public function bookNow()
    {
        $InfoUser = array();
        if (isset($_SESSION['user_id'])) {
            $InfoUser['name'] = $_SESSION['user_name'];
            $InfoUser['email'] = $_SESSION['email'];
            $InfoUser['phone'] = isset($_SESSION['user_phone']) ? $_SESSION['user_phone'] : '';
         } else {
            $InfoUser['name'] = '';
            $InfoUser['email'] = '';
            $InfoUser['phone'] = '';
        }

        $roomType = roomType::getAllData();
        $data = array('roomType' => $roomType, 'InfoUser' => $InfoUser);
        $this->folder = 'bookingRoom';
        $this->render('book', $data);
    }
    public function Contact()
    {
        $list = Facility::getAllData();
        $data = array('list' => $list);
        $this->folder = 'Contact';
        $this->render('Contact', $data);
    }
    public function rooms()
    {
        $roles = roles::getAllData();
        $lists = Rooms::getAllData();

        $data = array('lists' => $lists);
        $this->folder = 'rooms';
        $this->render('room', $data);
    }
    public function room_details()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $roomDetails = Rooms::findData($id);
        if ($roomDetails) {
            $data = ['roomDetails' => $roomDetails];
            $this->folder = 'rooms';
            $this->render('room_details', $data);
        } else {
            echo "Room details not found.";
        }
    } else {
        echo "Room ID not provided.";
    }
}
public function roomSelection()
{
    $selectedPerson = isset($_GET['person']) ? $_GET['person'] : 1;
    $checkinDate = isset($_GET['checkin_date']) ? DateTime::createFromFormat('d/m/Y', $_GET['checkin_date'])->format('Y-m-d') : null;
    $checkoutDate = isset($_GET['checkout_date']) ? DateTime::createFromFormat('d/m/Y', $_GET['checkout_date'])->format('Y-m-d') : null;


    try {
        $availableRooms = Booking::getAvailableRooms($selectedPerson, $checkinDate, $checkoutDate);
        $list = Facility::getAllData();
        $data = array('list' => $list, 'availableRooms' => $availableRooms);
        $this->folder = 'secureBooking';
        $this->render('roomSelection', $data);

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

public function secureBooking()
{
$serviceCharge = 109.918;
$VAT = 271.204;
$priceString = $_GET['price'];
$checkinDateString = $_GET['checkin_date'];
$checkoutDateString = $_GET['checkout_date'];
$price = intval(str_replace('.', '', $priceString));
$checkinDate = DateTime::createFromFormat('d/m/Y', $checkinDateString);
$checkoutDate = DateTime::createFromFormat('d/m/Y', $checkoutDateString);
$numberOfNights = $checkinDate->diff($checkoutDate)->days;
$totalPrice = $price * $numberOfNights + intval(str_replace('.', '', $serviceCharge))  + intval(str_replace('.', '', $VAT));
    $amount=$totalPrice;
    $InfoUser = array();
        if (isset($_SESSION['user_id'])) {
            $InfoUser['id'] =  $_SESSION['user_id'];
            $InfoUser['name'] = $_SESSION['user_name'];
            $InfoUser['email'] = $_SESSION['email'];
            $InfoUser['phone'] = isset($_SESSION['user_phone']) ? $_SESSION['user_phone'] : '';
        } else {
            $InfoUser['name'] = '';
            $InfoUser['email'] = '';
            $InfoUser['phone'] = '';
        }
        $room1ID = isset($_GET['Room1']) ? $_GET['Room1'] : null;
        $room2ID = isset($_GET['Room2']) ? $_GET['Room2'] : null;
        $room3ID = isset($_GET['Room3']) ? $_GET['Room3'] : null;
        $room1 = Booking::getRoomById($room1ID);
        $room2 = Booking::getRoomById($room2ID);
        $room3 = Booking::getRoomById($room3ID);


        $this->paymentGateways($amount, $checkinDateString, $checkoutDateString, $Room1, $Room2, $Room3);
        $data = array('room1' => $room1,
                      'room2' => $room2,
                      'room3' => $room3,
                      'InfoUser' => $InfoUser);
        $this->folder = 'booking';
        $this->render('secureBooking', $data);
    }

public function paymentGateways($amount)
    {

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/DUAN1/index.php?controller=client&action=redirect&checkin_date={$checkinDateString}&checkout_date={$checkoutDateString}&Room1={$Room1}&Room2={$Room2}&Room3={$Room3}";
        $vnp_TmnCode = "CGXZLS0Z"; //Mã website tại VNPAY
        $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật

        $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Nội dung thanh toán";
        $vnp_OrderType = "vnpay";
        $vnp_Amount = $amount * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo "<p id='displayedURL' style ='display: none'>$vnp_Url</p>";
        }
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                register::addUser($name, $email, $password);
                // Đăng kí thành công, có thể chuyển hướng hoặc thực hiện các hành động khác
                $message = "Đăng kí thành công";
                $data = array('message' => $message);
                $this->folder = 'register';
                $this->render('register', $data);
                echo '<script>window.location.href = "index.php?controller=client&action=signIn";</script>';
            } catch (Exception $e) {
                // Xử lý exception, hiển thị lỗi trên trang đăng ký
                $errorMessage = $e->getMessage();
                $data = array('error' => $errorMessage);
                $this->folder = 'register';
                $this->render('register', $data);
            }
        } else {
            $this->folder = 'register';
            $this->render('register');
        }
    }
    public function signIn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

        try {
            login::checkLogin($email, $password);
            header('Location: index.php?controller=client&action=home');
            exit();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $data = array('error' => $errorMessage);
            $this->folder = 'signIn';
            $this->render('sign-in', $data);
        }
    } else {
        $this->folder = 'signIn';
        $this->render('sign-in');
    }
}
public function logOut()
{
    $this->folder = 'signIn';
    $this->render('logOut');
}
public function profile()
{
    $this->folder = 'Setting';
    $this->render('profile');
}
public function booking_history()
{
    $this->folder = 'booking_history';
    $this->render('booking_history');
}

public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];

        // Kiểm tra xem 'gender' có tồn tại trong $_POST không
        $gender = isset($_POST['gender']) ? $_POST['gender'] : null;

        // Kiểm tra xem 'new_password' có tồn tại trong $_POST không
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;

        // Kiểm tra xem 'roles_id' có tồn tại trong $_POST không
        $roles_id = isset($_POST['roles_id']) ? $_POST['roles_id'] : null;

        $address = $_POST['address'];

        // Nếu người dùng nhập mật khẩu mới, thì hash nó
        $password = empty($new_password) ? null : password_hash($new_password, PASSWORD_DEFAULT);

        // Thực hiện cập nhật thông tin tài khoản
        login::updateData($id, $name, $email, $phone_number, $gender, $address, $password, $roles_id);

        // Cập nhật session với thông tin mới
        $_SESSION['user_name'] = $name;
        $message = "Dữ liệu đã được sửa thành công";
        $data = array('message' => $message);
        $this->folder = 'Setting';
        $this->render('update');
        // Chuyển hướng hoặc hiển thị thông báo cập nhật thành công
        // Ở đây, bạn có thể chuyển hướng đến trang profile hoặc hiển thị thông báo thành công.
        // Ví dụ: header('Location: index.php?controller=client&action=profile');
        // echo '<script>window.location.href = "index.php?controller=client&action=profile";</script>';
        echo "Cập nhật thành công!";
        exit();
    }
}


public function findProfile()
{
    // Kiểm tra xem có tham số 'id' trên URL không
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Gọi hàm findData để lấy dữ liệu cần thiết
        $value = login::findData($id);

        // Kiểm tra xem có dữ liệu trả về không
        if ($value) {
            // Chuyển hướng sang trang update với dữ liệu
            $data = array('value' => $value);
            $this->folder = 'Setting';
            $this->render('update', $data);
        } else {
            // Xử lý trường hợp không tìm thấy dữ liệu
            echo "Không tìm thấy dữ liệu!";
        }
    } else {
        // Xử lý trường hợp không có tham số 'id' trên URL
        echo "Thiếu tham số 'id' trên URL!";
    }
}

    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }
}
