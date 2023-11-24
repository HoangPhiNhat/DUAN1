<?php
require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
require_once("models/admin/rooms/rooms.php");
require_once("models/admin/roomTypes/roomType.php");

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
            Facility::addData($name, $email, $phone_number, $starts, $description, $address);
            // Hiển thị thông báo
            $message = "Dữ liệu đã được thêm thành công";
            $data = array('message' => $message);
            $this->folder = 'facilities';
            $this->render('add', $data);
            // Chuyển hướng người dùng
            header("Location: index.php?controller=admin&action=addFacility");
        } else {
            // Nếu không phải là phương thức POST, chỉ hiển thị form thêm dữ liệu
            $this->folder = 'facilities';
            $this->render('add');
        }
    }
    public function findFacility()
    {
        $value = Facility::findData($_GET['id']);
        $data = array('value' => $value);
        $this->folder = 'facilities';
        $this->render('update', $data);
    }
    public function updateFacility()
    {
        // Xử lý sửa dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $starts = $_POST['starts'];
            $description = $_POST['description'];
            $address = $_POST['address'];
            // echo "vc";
            // Thêm dữ liệu vào cơ sở dữ liệu
            Facility::updateData($id, $name, $email, $phone_number, $starts, $description, $address);
            // Hiển thị thông báo
            $message = "Dữ liệu đã được sửa thành công";
            $data = array('message' => $message);
            $this->folder = 'facilities';
            $this->render('update');
            // Chuyển hướng người dùng
            echo '<script>window.location.href = "index.php?controller=admin&action=facilityList";</script>';
            exit();
        }
    }
    public function facilityList()
    {
        $lists = Facility::getAllData();
        $data = array('lists' => $lists);
        $this->folder = 'facilities';
        $this->render('list', $data);
    }

    public function roomTypeList()
    {
        $lists = roomType::getAllData();
        $data = array('lists' => $lists);
        $this->folder = 'roomTypes';
        $this->render('list', $data);
    }
    public function addRoomType()
    {
        // Xử lý thêm dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            roomType::addData($name, $description);
            // Hiển thị thông báo
            $message = "Dữ liệu đã được thêm thành công";
            $data = array('message' => $message);
            $this->folder = 'roomTypes';
            $this->render('add', $data);
        } else {
            $this->folder = 'roomTypes';
            $this->render('add');
        }
    }
    public function findRoomType()
    {
        $value = roomType::findData($_GET['id']);
        $data = array('value' => $value);
        $this->folder = 'roomTypes';
        $this->render('update', $data);
    }

    public function updateRoomType()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            roomType::updateData($id, $name, $description);
            // Hiển thị thông báo
            $message = "Dữ liệu đã được sửa thành công";
            $data = array('message' => $message);
            $this->folder = 'roomTypes';
            $this->render('update');
            // Chuyển hướng người dùng
            echo '<script>window.location.href = "index.php?controller=admin&action=roomTypeList";</script>';
            exit();
        }
    }
    public function roomList()
    {
        $lists = Rooms::getAllData();
        $data = array('lists' => $lists);
        $this->folder = 'rooms';
        $this->render('list', $data);
    }
    public function addRoom()
    {
        $facility = Facility::getAllData();
        $roomType = roomType::getAllData();

        $data = array('facility' => $facility, 'roomType' => $roomType);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price_per_night = $_POST['price_per_night'];
            $capacity = $_POST['capacity'];
            $facility_id = $_POST['facility_id'];
            $room_type_id = $_POST['room_type_id'];
            $image_path = $_FILES['image_path']['name'];
            $target_dir = "../uploads";
            $target_file = $target_dir . basename($_FILES['image_path']['name']);
            if (move_uploaded_file($_FILES['image_path']['tmp_name'], $target_file)) {

            } else {

            }


            Rooms::addData($name, $price_per_night, $capacity,  $facility_id, $room_type_id, $image_path);
            $message = "Dữ liệu đã được thêm thành công";
            $data = array('message' => $message);
            $this->folder = 'rooms';
            $this->render('add', $data);
            exit;
        } else {
            $this->folder = 'rooms';
            $this->render('add', $data);
        }
    }

    public function findRoom()
    {
        $value = Rooms::findData($_GET['id']);
        $data = array('value' => $value);
        $this->folder = 'rooms';
        $this->render('update', $data);
    }

}
