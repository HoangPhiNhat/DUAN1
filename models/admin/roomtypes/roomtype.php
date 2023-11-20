<?php
class roomList
{
    public $singelroom;
    public $dbroom;
    public $fmlroom;
    public $viproom;
    public $budgetroom;
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
        $this->singelroom = $sgelroom;
        $this->dbroom = $dbroom;
        $this->fmlroom = $fmlroom;
        $this->viproom = $viproom;
        $this->budgetroom = $budgetroom;
        $this->description = $description;
        $this->address = $address;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
    }

    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM facilities');

        foreach ($req->fetchAll() as $value) {
            $list[] = new facilityList(
                $value['singelroom'],
                $value['dbroom'],
                $value[''],
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


}
