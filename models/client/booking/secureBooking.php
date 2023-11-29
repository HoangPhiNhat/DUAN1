<?php
class Booking
{
    public $id;
    public $customer_id;
    public $room_id;
    public $checkin_date;
    public $checkout_date;
    public $total_amount;

    public function __construct($id, $customer_id, $room_id, $checkin_date, $checkout_date, $total_amount)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->room_id = $room_id;
        $this->checkin_date = $checkin_date;
        $this->checkout_date = $checkout_date;
        $this->total_amount = $total_amount;
    }
    public static function reserveRoom($customer_id, $room_id, $checkin_date, $checkout_date, $total_amount)
    {
        $db = DB::getInstance();
        $query = "INSERT INTO room_reservations (customer_id, room_id, checkin_date, checkout_date, total_amount)
                  VALUES (:customer_id, :room_id, :checkin_date, :checkout_date, :total_amount)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':checkin_date', $checkin_date);
        $stmt->bindParam(':checkout_date', $checkout_date);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->execute();
        return $db->lastInsertId();
    }
    
}
