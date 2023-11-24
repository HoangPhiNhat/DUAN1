<?php
class roomType
{

    public $id;
    public $name;
    public $description;
    public $created_date;
    public $updated_date;

    function __construct(
        $id,
        $name,
        $description,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
    }

    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM room_types ORDER BY id desc');

        foreach ($req->fetchAll() as $value) {
            $list[] = new roomType(
                $value['id'],
                $value['name'],
                $value['description'],
                $value['created_date'],
                $value['updated_date']
            );
        }

        return $list;
    }
    static function addData($name, $description)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn INSERT INTO
        $query = 'INSERT INTO room_types (name, description, created_date, updated_date)
        VALUES (:name,:description, NOW(), NOW())';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function findData($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM room_types WHERE id = :id');
        $req->execute(array('id' => $id));

        $value = $req->fetch();
        if (isset($value['id'])) {
            return  new roomType(
                $value['id'],
                $value['name'],
                $value['description'],
                $value['created_date'],
                $value['updated_date']
            );
        }
        return null;
    }
    static function updateData($id, $name, $description)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn UPDATE
        $query = 'UPDATE room_types SET name = :name, description = :description
                  WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function getNameById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT name FROM room_types WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : null;
    }
    static function getDescriptionById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT description FROM room_types WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['description'] : null;
    }
}
