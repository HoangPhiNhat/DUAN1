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

    public static function getRoomById($room_id)
    {
        $db = DB::getInstance();
        $query = 'SELECT * FROM rooms WHERE id = :room_id';

        try {
            $stmt = $db->prepare($query);
            $stmt->bindParam(':room_id', $room_id);
            $stmt->execute();

            // Sử dụng fetch để lấy dữ liệu dưới dạng mảng kết hợp
            $roomData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($roomData) {
                // Tạo đối tượng Booking từ dữ liệu
                $roomObject = new Booking(
                    $roomData['id'],
                    $roomData['name'],
                    $roomData['price_per_night'],
                    $roomData['capacity'],
                    $roomData['facility_id'],
                    $roomData['room_type_id'],
                    $roomData['created_date'],
                    $roomData['updated_date'],
                    $roomData['image_path']
                );

                return $roomObject;
            } else {
                return null; // Trả về null nếu không tìm thấy phòng
            }
        } catch (PDOException $e) {
            // Xử lý lỗi, có thể log lỗi hoặc trả về giá trị mặc định
            return null;
        }
    }

    static function getAvailableRooms($selectedPerson, $checkinDate, $checkoutDate)
    {
        try {
            $db = DB::getInstance();

            $query = 'SELECT rooms.*, room_reservations.checkout_date
                      FROM rooms
                      LEFT JOIN room_reservations ON rooms.id = room_reservations.room_id
                      WHERE rooms.capacity <= :capacity
                        AND (room_reservations.checkin_date IS NULL
                             OR :checkout_date <= room_reservations.checkin_date
                             OR :checkin_date >= room_reservations.checkout_date)';

            $stmt = $db->prepare($query);
            $stmt->bindParam(':capacity', $selectedPerson);
            $stmt->bindParam(':checkin_date', $checkinDate);
            $stmt->bindParam(':checkout_date', $checkoutDate);
            $stmt->execute();
            $roomData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($roomData)) {
                throw new Exception("Rất tiếc là không còn phòng trống cho tiêu chí tìm kiếm của bạn.");
            }

            $roomObjects = [];
            foreach ($roomData as $room) {
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
        } catch (Exception $e) {
            throw new Exception("Error getting available rooms: " . $e->getMessage());
        }
    }

    static function updateRoomQuantities($selectedPerson, $checkinDate, $checkoutDate)
    {
        try {
            $db = DB::getInstance();
    
            $query = "SELECT r.room_type_id, COUNT(r.id) AS room_count
                FROM rooms r
                LEFT JOIN room_reservations rr ON r.id = rr.room_id
                WHERE r.capacity <= :capacity
                    AND (rr.checkin_date IS NULL
                         OR :checkin_date >= rr.checkout_date
                         OR rr.id IS NULL)
                GROUP BY r.room_type_id
    
                UNION
    
                SELECT r.room_type_id, COUNT(r.id) AS room_count
                FROM rooms r
                LEFT JOIN room_reservations rr ON r.id = rr.room_id
                WHERE r.capacity <= :capacity
                    AND (rr.checkout_date IS NULL
                         OR :checkout_date <= rr.checkin_date
                         OR rr.id IS NULL)
                GROUP BY r.room_type_id
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':capacity', $selectedPerson);
            $stmt->bindParam(':checkin_date', $checkinDate);
            $stmt->bindParam(':checkout_date', $checkoutDate);
            $stmt->execute();
            $roomTypeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($roomTypeData)) {
                throw new Exception("Rất tiếc là không còn phòng trống cho tiêu chí tìm kiếm của bạn.");
            }
    
            // Perform the logic to update room quantities based on $roomTypeData
            // ...
    
            return $roomTypeData;
        } catch (Exception $e) {
            throw new Exception("Lỗi khi cập nhật thông tin phòng: " . $e->getMessage());
        }
    }
}
