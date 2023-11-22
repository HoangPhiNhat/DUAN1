<?php
class Facility
{
    public $id;
    public $name;
    public $email;
    public $phone_number;
    public $starts;
    public $description;
    public $address;
    public $created_date;
    public $updated_date;

    function __construct(
        $id,
        $name,
        $email,
        $phone_number,
        $starts,
        $description,
        $address,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->starts = $starts;
        $this->description = $description;
        $this->address = $address;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
    }

    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM facilities ORDER BY id desc');

        foreach ($req->fetchAll() as $value) {
            $list[] = new Facility(
                $value['id'],
                $value['name'],
                $value['email'],
                $value['phone_number'],
                $value['starts'],
                $value['description'],
                $value['address'],
                $value['created_date'],
                $value['updated_date']
            );
        }

        return $list;
    }
    static function addData($name, $email, $phone_number, $starts, $description, $address)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn INSERT INTO
        $query = 'INSERT INTO facilities (name, email, phone_number, starts, description, address, created_date, updated_date)
        VALUES (:name, :email, :phone_number, :starts, :description, :address, NOW(), NOW())';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':starts', $starts);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':address', $address);

        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function findData($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM facilities WHERE id = :id');
        $req->execute(array('id' => $id));

        $value = $req->fetch();
        if (isset($value['id'])) {
            return new Facility(
                $value['id'],
                $value['name'],
                $value['email'],
                $value['phone_number'],
                $value['starts'],
                $value['description'],
                $value['address'],
                $value['created_date'],
                $value['updated_date']
            );
        }
        return null;
    }
    static function updateData($id, $name, $email, $phone_number, $starts, $description, $address)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn UPDATE
        $query = 'UPDATE facilities SET name = :name, email = :email, phone_number = :phone_number,
                  starts = :starts, description = :description, address = :address, updated_date = NOW()
                  WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':starts', $starts);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':address', $address);

        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function getNameById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT name FROM facilities WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : null;
    }
    
}
