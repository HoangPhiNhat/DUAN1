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

class ClientController extends BaseController
{
    function __construct()
    {
        $this->parentFolder = 'client';
        $this->subFolder = 'pages';
    }

    public function home()
    {
        $response_code = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : 'null';
        $successScript = '';

        if ($response_code == '00') {
            $successScript = "<script>swal({
                title: 'Thanh toán thành công',
                icon: 'success',
            });
            </script>";
            $customer_id = $_SESSION['user_id']; // Thay thế bằng cách nhận giá trị từ form hoặc request
            $room_id = $_GET['bookRoom'];
            $checkin_date_input = $_GET['checkin_date'];
            $checkin_date = DateTime::createFromFormat('d/m/Y', $checkin_date_input)->format('Y-m-d');
            $checkout_date_input = $_GET['checkout_date'];
            $checkout_date = DateTime::createFromFormat('d/m/Y', $checkout_date_input)->format('Y-m-d');
            $total_amount_trimmed = $_GET['vnp_Amount'];
            $total_amount = substr($total_amount_trimmed, 0, -2);
        try {
            $bookingId = SecureBooking::reserveRoom($customer_id, $room_id, $checkin_date, $checkout_date, $total_amount);
           // echo "Đặt phòng thành công. Mã đặt phòng: " . $bookingId;
        } catch (\Exception $e) {
            echo "Đặt phòng thất bại. Lỗi: " . $e->getMessage();
        }
    }


        $lists = Rooms::getAllData();
        $list = Facility::getAllData();
        $data = array('lists' => $lists, 'list' => $list, 'successScript' => $successScript);
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

            if (empty($availableRooms)) {
                // Không có phòng trống, báo lỗi
                $error = "Sorry, no available rooms for the selected dates and person.";
            } else {
                // Có phòng trống, tiếp tục xử lý
                $error = null;
            }

            // Tiếp tục xử lý và truyền thông báo lỗi vào mảng $data
            $list = Facility::getAllData();
            $data = array('list' => $list, 'availableRooms' => $availableRooms, 'error' => $error);
            $this->folder = 'secureBooking';
            $this->render('roomSelection', $data);
        } catch (Exception $e) {
            // Xử lý ngoại lệ nếu có
            $error = $e->getMessage();
            $data = array('error' => $error);
            $this->folder = 'secureBooking';
            $this->render('roomSelection', $data);
        }
    }


    public function secureBooking()
    {
        $bookRoom = $_GET['bookRoom'];
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
        $roomID = isset($_GET['bookRoom']) ? $_GET['bookRoom'] : null;
        $room = Booking::getRoomById($roomID);

        // Kiểm tra xem $room có tồn tại và có giá trị hợp lệ hay không
        if ($room) {
            echo "Room Name: " . $room->name;
            // ...
        } else {
            echo "Không tìm thấy thông tin phòng hoặc thông tin không hợp lệ.";
        }

        $this->paymentGateways($amount, $checkinDateString, $checkoutDateString, $bookRoom);
        $data = array('room' => $room, 'InfoUser' => $InfoUser);
        $this->folder = 'secureBooking';
        $this->render('secureBooking', $data);
    }

    public function paymentGateways($amount, $checkinDateString, $checkoutDateString, $bookRoom)
    {

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/DUAN1/index.php?controller=client&action=home&checkin_date={$checkinDateString}&checkout_date={$checkoutDateString}&bookRoom={$bookRoom}";
        $vnp_TmnCode = "CGXZLS0Z"; //Mã website tại VNPAY
        $vnp_HashSecret = "XNBCJFAKAZQSGTARRLGCHVZWCIOIGSHN"; //Chuỗi bí mật

        $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Nội dung thanh toán";
        $vnp_OrderType = "vnpay";
        $vnp_Amount = $amount * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        // //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
        // $vnp_Bill_City = $_POST['txt_bill_city'];
        // $vnp_Bill_Country = $_POST['txt_bill_country'];
        // $vnp_Bill_State = $_POST['txt_bill_state'];
        // Invoice
        // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
        // $vnp_Inv_Email = $_POST['txt_inv_email'];
        // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
        // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
        // $vnp_Inv_Company = $_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type = $_POST['cbo_inv_type'];
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
            // "vnp_ExpireDate" => $vnp_ExpireDate,
            // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
            // "vnp_Bill_Email" => $vnp_Bill_Email,
            // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
            // "vnp_Bill_LastName" => $vnp_Bill_LastName,
            // "vnp_Bill_Address" => $vnp_Bill_Address,
            // "vnp_Bill_City" => $vnp_Bill_City,
            // "vnp_Bill_Country" => $vnp_Bill_Country,
            // "vnp_Inv_Phone" => $vnp_Inv_Phone,
            // "vnp_Inv_Email" => $vnp_Inv_Email,
            // "vnp_Inv_Customer" => $vnp_Inv_Customer,
            // "vnp_Inv_Address" => $vnp_Inv_Address,
            // "vnp_Inv_Company" => $vnp_Inv_Company,
            // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
            // "vnp_Inv_Type" => $vnp_Inv_Type
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
            echo "<p id='displayedURL' style ='display:none'>$vnp_Url</p>";
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

    public function update()
    {
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
