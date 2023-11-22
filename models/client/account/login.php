<?php

class login {
    public $name;
    public $email;
    public $phone_number;
    public $password;

    function __construct(
        $name,
        $email,
        $phone_number,
        $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
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
        // Mật khẩu đúng, có thể thực hiện các hành động khác
        // ...
    } else {
        // Mật khẩu sai hoặc người dùng không tồn tại
        throw new Exception("Tài khoản hoặc mật khẩu không chính xác");
    }
}



}