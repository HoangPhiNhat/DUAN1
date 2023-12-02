<?php

class login
{
    public $id;
    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $roles_id;
    public $address;
    public $gender;

    function __construct(
        $id,
        $name,
        $email,
        $phone_number,
        $roles_id,
        $address,
        $gender,
        $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->roles_id = $roles_id;
        $this->address = $address;
        $this->gender = $gender;
        $this->password = $password;
    }

    static function checkLogin($email, $password)
    {
        $db = DB::getInstance();

        // Lấy thông tin người dùng từ CSDL
        $query = 'SELECT * FROM customers WHERE email = :email';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone_number'] = $user['phone'];
            header('Location: index.php?controller=client&action=home');
            exit();
        } else {
            throw new Exception("Tài khoản hoặc mật khẩu không chính xác");
        }
    }
   
    public static function updateData($id, $name, $email, $phone_number, $gender, $address, $roles_id)
    {
        $db = DB::getInstance();
    
        // Xây dựng câu lệnh SQL UPDATE
        $query = 'UPDATE customers 
                  SET name = :name, email = :email,
                      phone_number = IFNULL(:phone_number, phone_number),
                      gender = IFNULL(:gender, gender),
                      address = IFNULL(:address, address),
                      roles_id = IFNULL(:roles_id, roles_id)
                  WHERE id = :id';
    
        // Sử dụng PDO để thực hiện truy vấn
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':roles_id', $roles_id);
    
        $stmt->execute();
    }
    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM customers ORDER BY id desc');

        foreach ($req->fetchAll() as $value) {
            $list[] = new login(
                $value['id'],
                $value['name'],
                $value['email'],
                $value['phone_number'],
                $value['password'],
                $value['gender'],
                $value['address'],
                $value['roles_id']
            );
        }

        return $list;
    }

    static function findData($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM customers WHERE id = :id');
        $req->execute(array('id' => $id));

        $value = $req->fetch();
        if (isset($value['id'])) {
            return  new login(
                $value['id'],
                $value['name'],
                $value['email'],
                $value['phone_number'],
                $value['password'],
                $value['address'],
                $value['gender'],
                
                $value['roles_id']
            );
        }
        return null;
    }

    static function getUserInfoByID($user_id) {
        $db = DB::getInstance();
    
        // Thực hiện truy vấn để lấy thông tin người dùng dựa trên user_id
        $query = 'SELECT * FROM customers WHERE id = :user_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $user_info;
    }
    static function addComment($room_id, $customer_id, $comment_text)
    {
        $db = DB::getInstance(); 
        $customer_id = $_SESSION['user_id'];
        if (!isset($customer_id )) {
           echo 'vui lòng đăng nhập để bình luận';
            return false;
        }

        $query = "INSERT INTO comments (room_id, customer_id, comment_text) VALUES (:room_id, :customer_id, :comment_text)";
        $statement = $db->prepare($query);
        $statement->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $statement->bindParam(':customer_id', $customer_id , PDO::PARAM_INT);
        $statement->bindParam(':comment_text', $comment_text, PDO::PARAM_STR);

        // Thực hiện truy vấn
        $success = $statement->execute();

        return $success;
    }
    static function getNameById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT name FROM customers WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : null;
    }
    static function getNameId($customerId)
    {
        try {
            $db = DB::getInstance();
            $stmt = $db->prepare('SELECT name FROM customers WHERE id = :customer_id');
            $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result ? $result['name'] : null;
        } catch (PDOException $e) {
            // Log or display the error
            echo 'Error: ' . $e->getMessage();
            return null;
        }
    }
}