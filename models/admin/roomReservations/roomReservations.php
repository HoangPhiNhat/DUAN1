<?php
class roomReservation
{
    public $id;
    public $customer_id;
    public $room_id;
    public $checkin_date;
    public $checkout_date;
    public $total_amount;
    public $created_date;
    public $updated_date;
    public $status;

    function __construct(
        $id,
    $customer_id,
    $room_id,
    $checkin_date,
    $checkout_date,
    $total_amount,
    $created_date,
    $updated_date,
    $status
    ) {
        $this->id = $id;
        $this->customer_id  = $customer_id;
        $this->room_id  = $room_id;
        $this->checkin_date = $checkin_date;
        $this->checkout_date = $checkout_date;
        $this->total_amount = $total_amount;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
        $this->status = $status;
        
    }

    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM room_reservations ORDER BY id DESC');

        foreach ($req->fetchAll() as $value) {
            $list[] = new roomReservation(
                $value['id'],
                $value['customer_id'],
                $value['room_id'],
                $value['checkin_date'],
                $value['checkout_date'],
                $value['total_amount'],
                $value['created_date'],
                $value['updated_date'],
                $value['status']
            );
        }

        return $list;
    }

    static function findData($id)
    {
        $db = DB::getInstance();
        $req = $db->prepare('SELECT * FROM room_reservations WHERE id = :id');
        $req->execute(array('id' => $id));

        $value = $req->fetch();
        if (isset($value['id'])) {
            return  new roomReservation(
                $value['id'],
                $value['customer_id'],
                $value['room_id'],
                $value['checkin_date'],
                $value['checkout_date'],
                $value['total_amount'],
                $value['created_date'],
                $value['updated_date'],
                $value['status']
            );
        }
        return null;
    }

    static function updateData($id, $customer_id, $room_id, $status, $total_amount)
    {
        $db = DB::getInstance();

        // Thực hiện truy vấn UPDATE
        $query = 'UPDATE room_reservations SET customer_id = :customer_id, room_id = :room_id, status = :status, total_amount = :total_amount, updated_date = NOW()
                  WHERE id = :id';

        $stmt = $db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_amount', $total_amount);
        // Thực hiện truy vấn
        $stmt->execute();
    }
    static function getBookingHistory($user_name) {
        $db = DB::getInstance();

        // Use a prepared statement to prevent SQL injection
        $sql = "SELECT room_reservations.*, customers.name as customer_name
                FROM room_reservations
                INNER JOIN customers ON room_reservations.customer_id = customers.id
                WHERE customers.name = :user_name";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);

        $stmt->execute();

        $bookingHistory = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $bookingHistory[] = $row;
        }

        return $bookingHistory;
    }
    static function getNameById($customerId)
{
    try {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT name FROM customers WHERE id = :customer_id');
        $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['name'] : null;
    } catch (PDOException $e) {
        // Log or display the error
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}
   static function getEmailById($customerId)
{
    try {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT email FROM customers WHERE id = :customer_id');
        $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['email'] : null;
    } catch (PDOException $e) {
        // Log or display the error
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}
static function getPhoneById($customerId)
{
    try {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT phone_number FROM customers WHERE id = :customer_id');
        $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['phone_number'] : null;
    } catch (PDOException $e) {
        // Log or display the error
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}
static function getAddressById($customerId)
{
    try {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT address FROM customers WHERE id = :customer_id');
        $stmt->bindValue(':customer_id', $customerId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['address'] : null;
    } catch (PDOException $e) {
        // Log or display the error
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}

  
    
  
}

