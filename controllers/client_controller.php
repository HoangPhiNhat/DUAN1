<?php
require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
require_once("models/admin/rooms/rooms.php");
require_once("models/admin/roomTypes/roomType.php");
require_once("models/client/account/register.php");
require_once("models/client/account/login.php");

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

        $this->folder = 'bookingRoom';
        $this->render('book');
    }
    public function Contact()
    {

        $this->folder = 'Contact';
        $this->render('Contact');
    }
    public function rooms()
    {
        $lists = Rooms::getAllData();
        
        $data = array('lists' => $lists);
        $this->folder = 'rooms';
        $this->render('room', $data);
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


    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }
   
}
