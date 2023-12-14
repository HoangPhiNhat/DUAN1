<?php
class roles
{
    public $id;
    public $name;
    public function __construct(
        $id,
        $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }
    public static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM roles');

        foreach ($req->fetchAll() as $value) {
            $list[] = new roles( 
                $value['id'],
                $value['name'],
            );
        }
        return $list;
    }
    static function addData($name)
    {
        $db = DB::getInstance();
        $query = 'INSERT INTO roles (name)
        VALUES (:name)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        
        $stmt->execute();
    }
    static function getNameById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT name FROM roles WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : null;
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
                $value['phone_number'], $value['roles_id'],
                $value['password'],
                $value['address'],
                $value['gender'],
              
            );
        }
        return null;
    }
    public static function updateData($id, $name, $email, $phone_number, $roles_id)
{
    $db = DB::getInstance();
    
    // Xây dựng câu lệnh SQL UPDATE
    $query = 'UPDATE customers 
              SET name = :name, email = :email,
                  phone_number = COALESCE(:phone_number, phone_number),
                  roles_id = COALESCE(:roles_id, 2)
              WHERE id = :id';
    
    // Sử dụng PDO để thực hiện truy vấn
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':roles_id', $roles_id);
    
    $stmt->execute();
}

static function getRolesForCustomer($customerId) {
    try {
        $db = DB::getInstance();
        // Assuming you have a 'customers' table with 'roles_id' and 'name' columns
        $stmt = $db->prepare("SELECT roles_id, name FROM customers WHERE id = :id");
        $stmt->bindParam(':id', $customerId);
        $stmt->execute();

        $rolesData = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rolesData;
    } catch (PDOException $e) {
        // Handle database errors here
        die("Error fetching roles: " . $e->getMessage());
    }
}

}
    ?>