<?php session_start();

require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
require_once("models/admin/rooms/rooms.php");
require_once("models/admin/roomTypes/roomType.php");
require_once("models/client/account/register.php");
require_once("models/client/account/login.php");
require_once("models/client/comment/comment.php");
require_once("models/client/booking/booking.php");

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
        $lists = Rooms::getAllData();

        $data = array('lists' => $lists);
        $this->folder = 'rooms';
        $this->render('room', $data);
    }

    public function room_details()
    {
     
            $id = $_GET['id'];
            $Value = Rooms::findALLData($id);
            $roomDetails = Rooms::getRoomDetailsById($id);
            $comments = Comment::getCommentsByRoomId($id);
            $data = array(
                'Value' => $Value, 'roomDetails' => $roomDetails, 'comments' => $comments);

            $this->folder = 'rooms';
            $this->render('room_details', $data);
        
    }


    // public function findComments()
    // {
    //     // Lấy thông tin chi tiết của phòng
    //     $roomDetails = Rooms::getRoomDetailsById($_GET['id']);
    //     if (!$roomDetails) {
    //         // Xử lý trường hợp không tìm thấy thông tin phòng
    //         echo "Không tìm thấy thông tin về phòng.";
    //         return;
    //     }
    //     $comments = Comment::getCommentsByRoomId($roomDetails->$_GET['id']);

    //     // Chuyển dữ liệu bình luận và thông tin phòng cho view
    //     $data = array('roomDetails' => $roomDetails, 'comments' => $comments);
    //     $this->folder = 'rooms';
    //     $this->render('room_details', $data);
    // }


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
