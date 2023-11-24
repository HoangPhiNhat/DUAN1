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
    // Verify if 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Get room details based on the room ID
        $roomDetails = Rooms::findData($id);


        if ($roomDetails) {
            // Pass the room details to the view

            $data = ['roomDetails' => $roomDetails];
            $this->folder = 'rooms';
            $this->render('room_details', $data);
        } else {
            // Handle the case when room details are not found
            echo "Room details not found.";
        }
    } else {
        // Handle the case when 'id' parameter is not set
        echo "Room ID not provided.";
    }
}



    public function register() {
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


    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }

}
