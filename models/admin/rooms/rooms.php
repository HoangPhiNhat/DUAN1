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
    static function updateData($id, $name, $price_per_night, $capacity, $facility_id, $room_type_id)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn UPDATE
        $query = 'UPDATE rooms SET name = :name, price_per_night = :price_per_night, capacity = :capacity,
                  facility_id = :facility_id, room_type_id = :room_type_id, updated_date = NOW()
                  WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price_per_night', $price_per_night);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':facility_id', $facility_id);
        $stmt->bindParam(':room_type_id', $room_type_id);

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
    static function getimagepathId($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT image_path FROM rooms WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['image_path'] : null;
    }
    static function getfacilityidById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT facility_id FROM rooms WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['facility_id'] : null;
    }
    static function getroomtypeidById($roomTypeId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT room_type_id FROM rooms WHERE id = ?');
        $stmt->execute([$roomTypeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['room_type_id'] : null;
    }
    

}
