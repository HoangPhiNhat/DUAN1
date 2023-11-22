<?php

class register {
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
    static function addUser($name, $email, $password) {
        $db = DB::getInstance();
        if (self::userExists($email)) {
            throw new Exception("Email đã ");
        } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO customers (name, email, password)
                   VALUES (:name, :email, :password)';

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // Thực hiện truy vấn
        $stmt->execute();
        }
    }

    static function userExists($email) {
        $db = DB::getInstance();
        $query = 'SELECT * FROM customers WHERE email = :email';
        $stmt = $db->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($user !== false);
    }

}