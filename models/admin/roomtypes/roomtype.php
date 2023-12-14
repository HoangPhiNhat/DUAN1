<?php
class roomType
{

    public $id;
    public $name;
    public $description;
    public $total_quantity;
    public $created_date;
    public $updated_date;

    function __construct(
        $id,
        $name,
        $description,
        $total_quantity,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->total_quantity = $total_quantity;
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
                $value['total_quantity'],
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
                $value['total_quantity'],
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
    static function getTotalQuantityById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("SELECT total_quantity FROM room_types WHERE id = ?");
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['total_quantity'] : null;
    }
    static function getDescriptionById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT description FROM room_types WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['description'] : null;
    }
    //roomtype/list
    static function getRoomCounts()
    {
        try {
            $db = DB::getInstance(); // Assume DB::getInstance() returns a PDO object

            $query = 'SELECT room_types.id, COUNT(rooms.id) AS room_count
                      FROM room_types
                      LEFT JOIN rooms ON room_types.id = rooms.room_type_id
                      GROUP BY room_types.id';

            $stmt = $db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors
            throw new Exception("Error retrieving room counts: " . $e->getMessage());
        }
    }

    static function updateTotalQuantity($roomTypeId, $totalQuantity)
    {
        try {
            $db = DB::getInstance(); // Assume DB::getInstance() returns a PDO object

            $query = 'UPDATE room_types SET total_quantity = :totalQuantity WHERE id = :roomTypeId';

            $stmt = $db->prepare($query);
            $stmt->bindParam(':totalQuantity', $totalQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':roomTypeId', $roomTypeId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle errors
            throw new Exception("Error updating total_quantity: " . $e->getMessage());
        }
    }

}
