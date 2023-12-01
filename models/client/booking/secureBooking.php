<?php
class SecureBooking
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

        $db->beginTransaction();

        try {
            $queryRoomReservations = "INSERT INTO room_reservations (customer_id, room_id, checkin_date, checkout_date, total_amount, created_date, updated_date)
                                    VALUES (:customer_id, :room_id, :checkin_date, :checkout_date, :total_amount, NOW(), NOW())";
            $stmtRoomReservations = $db->prepare($queryRoomReservations);
            $stmtRoomReservations->bindValue(':customer_id', $customer_id);
            $stmtRoomReservations->bindValue(':room_id', $room_id);
            $stmtRoomReservations->bindValue(':checkin_date', $checkin_date);
            $stmtRoomReservations->bindValue(':checkout_date', $checkout_date);
            $stmtRoomReservations->bindValue(':total_amount', $total_amount);
            $stmtRoomReservations->execute();

            $bookingId = $db->lastInsertId();
            $queryHotelPayment = "INSERT INTO hotel_payment (transaction_date, confirmation_code, customer_id, price, message, status)
                                VALUES (NOW(), :confirmation_code, :customer_id, :price, :message, :status)";
            $stmtHotelPayment = $db->prepare($queryHotelPayment);
            $stmtHotelPayment->bindValue(':confirmation_code', $bookingId . time()); // Điều chỉnh cách tạo confirmation_code
            $stmtHotelPayment->bindValue(':customer_id', $customer_id);
            $stmtHotelPayment->bindValue(':price', $total_amount);
            $stmtHotelPayment->bindValue(':message', 1); // Chưa rõ cách xử lý message
            $stmtHotelPayment->bindValue(':status', 'success'); // Chưa rõ cách xử lý status
            $stmtHotelPayment->execute();


            $db->commit();

            return $bookingId;
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e; // Hoặc xử lý lỗi theo cách bạn muốn
        }
    }
}
