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
        $stmt = $db->prepare('SELECT total_quantity FROM room_types WHERE id = ?');
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
    static function getRemainingQuantityById($roomTypeId)
    {
        try {
            $db = DB::getInstance(); // Giả sử DB::getInstance() trả về một đối tượng PDO

            $query = 'SELECT total_quantity FROM room_types WHERE id = :roomTypeId';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':roomTypeId', $roomTypeId, PDO::PARAM_INT);
            $stmt->execute();
            $remainingQuantity = $stmt->fetch(PDO::FETCH_ASSOC)['total_quantity'];

            return $remainingQuantity;
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    static function updateRoomCountInDatabase($roomTypeId)
{
    try {
        $db = DB::getInstance(); // Assuming DB::getInstance() returns a PDO object
    
        // Step 1: Count the current total quantity of rooms for the room type
        $countQuery = 'SELECT COUNT(id) AS current_quantity FROM rooms WHERE room_type_id = :roomTypeId';
        $countStmt = $db->prepare($countQuery);
        $countStmt->bindParam(':roomTypeId', $roomTypeId, PDO::PARAM_INT);
        $countStmt->execute();
        $currentQuantity = $countStmt->fetch(PDO::FETCH_ASSOC)['current_quantity'];
    
        // Step 2: Update the room_type table with the current quantity information
        $updateQuery = 'UPDATE room_types SET total_quantity = :currentQuantity WHERE id = :roomTypeId';
        $updateStmt = $db->prepare($updateQuery);
    
        // Giảm số lượng phòng, đảm bảo không dưới 0
        $currentQuantity = max(0, $currentQuantity - 1);
    
        // In ra câu truy vấn SQL
        echo "Update Query: " . $updateQuery . PHP_EOL;
    
        // In ra giá trị hiện tại của $currentQuantity
        echo "Current Quantity: " . $currentQuantity . PHP_EOL;
    
        $updateStmt->bindParam(':currentQuantity', $currentQuantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':roomTypeId', $roomTypeId, PDO::PARAM_INT);
        $updateStmt->execute();
    } catch (PDOException $e) {
        // Handle errors
        echo "Error updating room quantity: " . $e->getMessage() . PHP_EOL;
        // Ném ngoại lệ để thông báo lỗi cho phía gọi hàm
        throw new Exception("Error updating room quantity: " . $e->getMessage());
    }
}
static function getAllRoomTypes()
{
    try {
        $db = DB::getInstance(); // Assuming DB::getInstance() returns a PDO object

        $query = 'SELECT * FROM room_types';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $roomTypes;
    } catch (PDOException $e) {
        // Xử lý lỗi nếu có
        throw new Exception("Error getting room types: " . $e->getMessage());
    }
}
}
