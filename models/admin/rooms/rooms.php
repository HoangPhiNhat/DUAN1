<?php
class Rooms
{
    public $id;
    public $name;
    public $price_per_night;
    public $capacity;
    public $facility_id;
    public $room_type_id;
    public $image_path;
    public $created_date;
    public $updated_date;

    function __construct(
        $id,
        $name,
        $price_per_night,
        $capacity,
        $facility_id,
        $room_type_id,
        $image_path,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price_per_night = $price_per_night;
        $this->capacity = $capacity;
        $this->facility_id = $facility_id;
        $this->room_type_id = $room_type_id;
        $this->image_path = $image_path;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
    }

    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM rooms ORDER BY id desc');

        foreach ($req->fetchAll() as $value) {
            $list[] = new Rooms(
                $value['id'],
                $value['name'],
                $value['price_per_night'],
                $value['capacity'],
                $value['facility_id'],
                $value['room_type_id'],
                $value['image_path'],
                $value['created_date'],
                $value['updated_date']
            );
        }

        return $list;
    }
    static function findData($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM rooms WHERE id = :id');
        $req->execute(array('id' => $id));

        $value = $req->fetch();
        if (isset($value['id'])) {
            return new Rooms(
                $value['id'],
                $value['name'],
                $value['price_per_night'],
                $value['capacity'],
                $value['facility_id'],
                $value['room_type_id'],
                $value['image_path'],
                $value['created_date'],
                $value['updated_date']
            );
        }
        return null;
    }
    static function updateData($id,  $price_per_night,)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn UPDATE
        $query = 'UPDATE rooms SET price_per_night = :price_per_night, updated_date = NOW()
                  WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':price_per_night', $price_per_night);

        // Thực hiện truy vấn
        $stmt->execute();
    }

    static function addData($name, $price_per_night, $capacity, $facility_id, $room_type_id, $image_path)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn INSERT INTO
        $query = 'INSERT INTO rooms (name, price_per_night, capacity, facility_id, image_path, room_type_id, created_date, updated_date)
        VALUES (:name, :price_per_night, :capacity, :facility_id, :image_path, :room_type_id, NOW(), NOW())';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price_per_night', $price_per_night);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':facility_id', $facility_id);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':room_type_id', $room_type_id);

        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function getImagePathId($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT image_path FROM rooms WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['image_path'] : null;
    }
    static function getNameById($roomId)
{
    $db = DB::getInstance();
    $stmt = $db->prepare('SELECT name FROM rooms WHERE id = ?');
    $stmt->execute([$roomId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['name'] : null;
}
    static function getData($roomId)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM rooms WHERE id = :id');
        $req->execute(['id' => $roomId]);

        $value = $req->fetch();

        if ($value) {
            return new Rooms(
                $value['id'],
                $value['name'],
                $value['price_per_night'],
                $value['capacity'],
                $value['facility_id'],
                $value['room_type_id'],
                $value['image_path'],
                $value['created_date'],
                $value['updated_date']
            );
        }

        return null;
    }
    static function findALLData($id)
    {
        $db = DB::getInstance();
        $statement = $db->prepare('SELECT * FROM rooms WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $roomDetails = $statement->fetch(PDO::FETCH_OBJ);

        return $roomDetails;
    }
    static function getRoomDetailsById($roomId)
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM rooms WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $roomId, PDO::PARAM_INT);
        $statement->execute();
        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $room = new Rooms(
                $row['id'],
                $row['name'],
                $row['price_per_night'],
                $row['capacity'],
                $row['facility_id'],
                $row['room_type_id'],
                $row['image_path'],
                $row['created_date'],
                $row['updated_date']
            );
            return $room;
        } else {
            return null;
        }
    }
    static function getRoomsByCapacity($currentRoomCapacity)
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM rooms WHERE capacity = :capacity";
        $statement = $db->prepare($query);
        $statement->bindParam(':capacity', $currentRoomCapacity, PDO::PARAM_INT);
        $statement->execute();

        $rooms = array();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $room = new Rooms(
                $row['id'],
                $row['name'],
                $row['price_per_night'],
                $row['capacity'],
                $row['facility_id'],
                $row['room_type_id'],
                $row['image_path'],
                $row['created_date'],
                $row['updated_date']
            );
            $rooms[] = $room;
        }

        return $rooms;
    }
    //
    static function hideReservedRooms()
    {
        try {
            $db = DB::getInstance();

            $query = "UPDATE rooms r
                    SET r.available_date = (
                        SELECT MAX(checkout_date)
                        FROM room_reservations
                        WHERE room_id = r.id AND status = 'Chờ Xác Nhận'
                    )
                    WHERE r.id IN (
                        SELECT room_id
                        FROM room_reservations
                        WHERE status = 'Chờ Xác Nhận'
                    )";

            $statement = $db->prepare($query);
            $statement->execute();
        } catch (PDOException $e) {
            error_log("Error hiding reserved rooms: " . $e->getMessage());
            throw new Exception("Error hiding reserved rooms: " . $e->getMessage());
        }

        return $statement;
    }
}

