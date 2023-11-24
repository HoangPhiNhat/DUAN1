<?php
class Booking
{
    public $id;
    public $name;
    public $price_per_night;
    public $capacity;
    public $facility_id;
    public $room_type_id;
    public $created_date;
    public $updated_date;
    public $image_path;

    public function __construct($id, $name, $price_per_night, $capacity, $facility_id, $room_type_id, $created_date, $updated_date, $image_path)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price_per_night = $price_per_night;
        $this->capacity = $capacity;
        $this->facility_id = $facility_id;
        $this->room_type_id = $room_type_id;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
        $this->image_path = $image_path;
    }

    public static function getRoomsByType($room_type_id, $db)
    {
        $query = 'SELECT * FROM rooms WHERE room_type_id = :room_type_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':room_type_id', $room_type_id);
        $stmt->execute();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $roomObjects = [];
        foreach ($rooms as $room) {
            $roomObjects[] = new Booking(
                $room['id'],
                $room['name'],
                $room['price_per_night'],
                $room['capacity'],
                $room['facility_id'],
                $room['room_type_id'],
                $room['created_date'],
                $room['updated_date'],
                $room['image_path']
            );
        }

        return $roomObjects;
    }
}

