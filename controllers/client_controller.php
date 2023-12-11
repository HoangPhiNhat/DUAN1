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
    public function home()
    {
        $response_code = isset($_GET['vnp_ResponseCode']) ? $_GET['vnp_ResponseCode'] : 'null';
        $successScript = '';

        if ($response_code == '00') {
            $successScript = "<script>swal({
                title: 'Thanh toán thành công',
                icon: 'success'
            });
            </script>";
            $customer_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $room_id = isset($_GET['bookRoom']) ? $_GET['bookRoom'] : null;
            $checkin_date_input = isset($_GET['checkin_date']) ? $_GET['checkin_date'] : null;
            $checkout_date_input = isset($_GET['checkout_date']) ? $_GET['checkout_date'] : null;
            $total_amount_trimmed = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] : null;

            if ($customer_id && $room_id && $checkin_date_input && $checkout_date_input && $total_amount_trimmed) {
                try {
                    // Chuyển định dạng ngày tháng
                    $checkin_date = DateTime::createFromFormat('d/m/Y', $checkin_date_input)->format('Y-m-d');
                    $checkout_date = DateTime::createFromFormat('d/m/Y', $checkout_date_input)->format('Y-m-d');

                    // Loại bỏ các ký tự không mong muốn từ giá trị total_amount
                    $total_amount = preg_replace("/[^0-9]/", "", $total_amount_trimmed);

                    // Gọi hàm để đặt phòng
                    $bookingId = SecureBooking::reserveRoom($customer_id, $room_id, $checkin_date, $checkout_date, $total_amount);
                    // Nếu cần, bạn có thể in ra thông báo đặt phòng thành công ở đây
                } catch (\Exception $e) {
                    // Xử lý lỗi khi đặt phòng thất bại
                    echo "Đặt phòng thất bại. Lỗi: " . $e->getMessage();
                }
            }

            // Chuyển hướng về trang chủ sau khi xử lý thanh toán thành công
            header("Location: index.php?controller=client&action=home");
            exit();
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
        // Assuming you have a static function getBookingHistory in your model

        $bookingHistory = roomReservation::getBookingHistory($user_name); // Call the static method
        $list = Facility::getAllData();
        $data = array('bookingHistory' => $bookingHistory, 'list' => $list);
        // Load the view
        $this->folder = 'booking_history';
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
            // Không có phòng trống, báo lỗi
            $error = "Sorry, no available rooms for the selected dates and person.";
        } else {
            // Có phòng trống, tiếp tục xử lý
            $error = null;

            // Đặt phòng và cập nhật số lượng phòng còn lại
            $bookedRoomId = isset($_GET['bookRoom']) ? $_GET['bookRoom'] : null;

            if ($bookedRoomId) {
                // Lấy thông tin phòng từ room_reservations
                $reservationInfo = roomReservation::getReservationInfo($bookedRoomId);

                // Kiểm tra xem có thông tin đặt phòng hay không
                if ($reservationInfo) {
                    // Lấy thông tin phòng từ đối tượng $reservationInfo
                    $roomId = $reservationInfo['room_id'];
                    $roomInfo = Rooms::getRoomInfoById($roomId);
                    $roomTypeId = $roomInfo['room_type_id'];
                    
                    // Giảm số lượng phòng còn lại cho loại phòng
                    RoomType::updateRoomCountInDatabase($roomTypeId);
                    var_dump($roomTypeId);
                } else {
                    // Xử lý khi không tìm thấy thông tin đặt phòng
                    $error = "Không tìm thấy thông tin đặt phòng.";
                }
            }
        }

        // Lấy số lượng loại phòng
        $roomTypes = RoomType::getAllRoomTypes(); // Bạn cần triển khai hàm getAllRoomTypes trong model RoomType

        // Lấy số lượng phòng còn lại cho mỗi loại phòng
        $remainingQuantities = [];
        foreach ($roomTypes as $roomType) {
            $remainingQuantity = RoomType::getRemainingQuantityById($roomType['id']);
            $remainingQuantities[$roomType['id']] = $remainingQuantity;
        }

        // Kiểm tra giá trị của remainingQuantities
        var_dump($remainingQuantities);

        // Tiếp tục xử lý và truyền thông báo lỗi vào mảng $data
        $list = Facility::getAllData();
        $data = array('list' => $list, 'availableRooms' => $availableRooms, 'error' => $error, 'roomTypes' => $roomTypes, 'remainingQuantities' => $remainingQuantities);
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
                $rating = $_POST['rating'];
                $comment_text = $_POST['comment_text'];
                if (isset($_POST['room_id'])) {
                    $room_id = $_POST['room_id'];
                    $success = login::addComment($room_id, $customer_id, $rating, $comment_text);
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
    // public function roomSame($currentRoomName, $currentRoomTypeId)
    // {
    //     // Fetch details of the current room
    //     $similarRooms = Rooms::getSimilarRooms($currentRoomName, $currentRoomTypeId);

    //     // Debugging: var_dump the result
    //     var_dump($similarRooms);

    //     $data = array(
    //         'similarRooms' => $similarRooms
    //     );

    //     $this->folder = 'rooms';
    //     $this->render('room_details', $data);
    // }
    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }
}
