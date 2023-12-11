<?php
class Dashboard
{
    public $id;
    public $transaction_date;
    public $confirmation_code;
    public $customer_id;
    public $price;
    public $message;
    public $status;

    function __construct(
        $id,
        $transaction_date,
        $confirmation_code,
        $customer_id,
        $price,
        $message,
        $status,
    ) {
        $this->id = $id;
        $this->transaction_date = $transaction_date;
        $this->confirmation_code = $confirmation_code;
        $this->customer_id = $customer_id;
        $this->price = $price;
        $this->message = $message;
        $this->status = $status;
    }
    static function calculateTotal()
{
    $db = DB::getInstance();

    $query = "SELECT SUM(price) FROM hotel_payment";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['SUM(price)'];
}
static function totalRooms()
{
    $db = DB::getInstance();

    $query = "SELECT COUNT(*) FROM rooms";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['COUNT(*)'];
}
static function totalRoomReservations()
{
    $db = DB::getInstance();

    $query = "SELECT COUNT(*) FROM room_reservations";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['COUNT(*)'];
}
}