<?php session_start();

require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
require_once("models/admin/rooms/rooms.php");
require_once("models/admin/roomTypes/roomType.php");
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
    public function redirect()
    {

            $customer_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $room_id = isset($_GET['Room1']) ? $_GET['Room1'] : null;
            $checkin_date_input = isset($_GET['checkin_date']) ? $_GET['checkin_date'] : null;
            $checkout_date_input = isset($_GET['checkout_date']) ? $_GET['checkout_date'] : null;
            $total_amount_trimmed = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : null;
           $total =  $total_amount_trimmed / 100;

            if ($customer_id && $room_id && $checkin_date_input && $checkout_date_input && $total) {
                try {
                    $checkin_date = DateTime::createFromFormat('d/m/Y', $checkin_date_input)->format('Y-m-d');
                    $checkout_date = DateTime::createFromFormat('d/m/Y', $checkout_date_input)->format('Y-m-d');
                    $total_amount = preg_replace("/[^0-9]/", "", $total);
                    echo  $total_amount;
                    $bookingId = SecureBooking::reserveRoom($customer_id, $room_id, $checkin_date, $checkout_date, $total_amount);
                } catch (\Exception $e) {
                    // Xử lý lỗi khi đặt phòng thất bại
                    echo "Đặt phòng thất bại. Lỗi: " . $e->getMessage();
                }
            }

        $this->folder = 'home';
        $this->render('redirect');
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
        $roomType = roomType::getAllData();
        $data = array('roomType' => $roomType);
        $this->folder = 'booking';
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
        $lists = Rooms::getAllData();
        $list = Facility::getAllData();
        $data = array('lists' => $lists, 'list' => $list);
        $this->folder = 'rooms';
        $this->render('room', $data);
    }

    public function room_details()
    {

        $id = $_GET['id'];
        $Value = Rooms::findALLData($id);
        $roomDetails = Rooms::getRoomDetailsById($id);
        $comments = Comment::getCommentsByRoomId($id);
        $list = Facility::getAllData();
        $data = array(
            'Value' => $Value, 'roomDetails' => $roomDetails, 'comments' => $comments, 'list' => $list
        );

        $this->folder = 'rooms';
        $this->render('room_details', $data);
    }

    public function booking_history()
    {
        $user_name = $_SESSION['user_name'];
        $bookingHistory = roomReservation::getBookingHistory($user_name);
        $list = Facility::getAllData();
        $data = array('bookingHistory' => $bookingHistory, 'list' => $list);
        $this->folder = 'booking';
        $this->render('booking_history', $data);
    }
    public function roomSelection()
    {
        $selectedPerson = isset($_GET['person']) ? $_GET['person'] : 1;
        $checkinDate = isset($_GET['checkin_date']) ? DateTime::createFromFormat('d/m/Y', $_GET['checkin_date'])->format('Y-m-d') : null;
        $checkoutDate = isset($_GET['checkout_date']) ? DateTime::createFromFormat('d/m/Y', $_GET['checkout_date'])->format('Y-m-d') : null;

        try {
            $availableRooms = Booking::getAvailableRooms($selectedPerson, $checkinDate, $checkoutDate);

            if (empty($availableRooms)) {
                $error = ".";
            } else {
                $error = null;
            }
            $list = Facility::getAllData();
            $data = array('list' => $list, 'availableRooms' => $availableRooms, 'error' => $error);
            $this->folder = 'booking';
            $this->render('roomSelection', $data);
        } catch (Exception $e) {
            // Xử lý ngoại lệ nếu có
            $error = $e->getMessage();
            $data = array('error' => $error);
            $this->folder = 'booking';
            $this->render('roomSelection', $data);
        }
    }

    public function secureBooking()
    {
        $Room1 = intval($_GET['Room1']);
        $Room2 = isset($_GET['Room2']) ? intval($_GET['Room2']) : null;
        $Room3 = isset($_GET['Room3']) ? intval($_GET['Room3']) : null;
        $serviceCharge = 109.918;
        $VAT = 271.204;
        $price1 = isset($_GET['price1']) ? intval(str_replace('.', '', $_GET['price1'])) : 0;
        $price2 = isset($_GET['price2']) ? intval(str_replace('.', '', $_GET['price2'])) : 0;
        $price3 = isset($_GET['price3']) ? intval(str_replace('.', '', $_GET['price3'])) : 0;
        $checkinDateString = $_GET['checkin_date'];
        $checkoutDateString = $_GET['checkout_date'];
        $checkinDate = DateTime::createFromFormat('d/m/Y', $checkinDateString);
        $checkoutDate = DateTime::createFromFormat('d/m/Y', $checkoutDateString);
        $numberOfNights = $checkinDate->diff($checkoutDate)->days;
        $totalPrice = ($price1 + $price2 + $price3) * $numberOfNights + intval(str_replace('.', '', $serviceCharge)) + intval(str_replace('.', '', $VAT));
        $amount = $totalPrice;
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


    public function paymentGateways($amount, $checkinDateString, $checkoutDateString, $Room1, $Room2, $Room3)
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
        $list = Facility::getAllData();
        $data = array('list' => $list);
        $this->folder = 'Setting';
        $this->render('profile', $data);
    }



    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy các dữ liệu từ form
            $id = $_SESSION['user_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $password = $_POST['password'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $roles_id = isset($_POST['roles_id']) ? $_POST['roles_id'] : null;
            $address = $_POST['address'];
            login::updateData($id, $name, $email, $phone_number, $gender, $address, $password, $roles_id);

            // Cập nhật session với thông tin mới
            $_SESSION['user_name'] = $name;
            $message = "Dữ liệu đã được sửa thành công";
            $data = array('message' => $message);
            $this->folder = 'Setting';
            $this->render('update');
            echo "Cập nhật thành công!";
            header('Location: index.php?controller=client&action=profile');
            exit();
        }
    }

    public function findProfile()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $value = login::findData($id);
            if ($value) {
                $data = array('value' => $value);
                $this->folder = 'Setting';
                $this->render('update', $data);
            } else {
                echo "Không tìm thấy dữ liệu!";
            }
        } else {
            echo "Thiếu tham số 'id' trên URL!";
        }
    }
    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['user_id'])) {
                $customer_id = $_SESSION['user_id'];
                $comment_text = $_POST['comment_text'];
                if (isset($_POST['room_id'])) {
                    $room_id = $_POST['room_id'];
                    $success = login::addComment($room_id, $customer_id, $comment_text);
                    if ($success) {
                        echo "Bình luận đã được thêm vào cơ sở dữ liệu.";
                    } else {
                        echo "Có lỗi xảy ra khi thêm bình luận.";
                    }
                    header("Location: index.php?controller=client&action=room_details&id=" . $room_id);
                    exit();
                } else {
                    echo "Không có thông tin về phòng.";
                }
            } else {
                echo "Bạn cần đăng nhập để thêm bình luận.";
            }
        }
        $this->folder = 'rooms';
        $this->render('room_details');
    }

    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }
}
