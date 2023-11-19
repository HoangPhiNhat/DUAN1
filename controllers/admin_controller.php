<?php
require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");

class AdminController extends BaseController
{
    function __construct()
    {
        $this->parentFolder = 'admin';
        $this->subFolder = 'pages';
    }

    public function dashboard()  
    {
        $this->folder = 'dashboard';
        $this->render('dashboard');
    }
    public function facilityList()
    {
        $lists = facilityList::getAllData();
        $data = array('lists' => $lists);
        $this->folder = 'facilities';
        $this->render('list', $data);
    }
    public function addFacility()
    {
        // Xử lý thêm dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Lấy dữ liệu từ form
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone_number = $_POST['phone_number'];
                $starts = $_POST['starts'];
                $description = $_POST['description'];
                $address = $_POST['address'];
                // echo "vc";
                // Thêm dữ liệu vào cơ sở dữ liệu
                facilityList::addData($name, $email, $phone_number, $starts, $description, $address);
                // Hiển thị thông báo
                $message = "Dữ liệu đã được thêm thành công";
                $data = array('message' => $message);
                $this->folder = 'facilities';
                $this->render('add', $data);
                // Chuyển hướng người dùng
              //  header("Location: index.php?controller=admin&action=addFacility");

            } else {
                // Nếu không phải là phương thức POST, chỉ hiển thị form thêm dữ liệu
                $this->folder = 'facilities';
                $this->render('add');
            }
        }

    public function updateFacility()
    {
        $this->folder = 'facilities';
        $this->render('update_facility');
    }
}
