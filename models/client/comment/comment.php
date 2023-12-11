<?php
class Comment
{
    public $comment_id;
    public $customer_id;
    public $room_id;
    public $comment_text;
    public $created_at;
    public $rating;

    public function __construct($comment_id, $room_id, $customer_id, $comment_text, $rating, $created_at)
    {
        $this->comment_id = $comment_id;
        $this->room_id = $room_id;
        $this->customer_id = $customer_id;
        $this->comment_text = $comment_text;
        $this->rating = $rating;
        $this->created_at = $created_at;
    }
    static function getAllData()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM comments ORDER BY comment_id desc');

        foreach ($req->fetchAll() as $value) {
            $list[] = new Comment(
                $value['comment_id'],
                $value['room_id'],
                $value['customer_id'],
                $value['comment_text'],
                $value['rating'],
                $value['created_at']
            );
        }

        return $list;
    }


    static function getName($customerId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT customer_id FROM customers WHERE id = ?');
        $stmt->execute([$customerId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['customer_id'] : null;
    }
    static function getAllComments()
    {
        $db = DB::getInstance();
        $query = "SELECT * FROM comments";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    static function getCommentsByRoomId($roomId)
    {
        
        $db = DB::getInstance();
        $query = "SELECT * FROM comments WHERE room_id = :room_id ORDER BY created_at DESC";
        $statement = $db->prepare($query);
        $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
        $statement->execute();
        $commentData = $statement->fetchAll(PDO::FETCH_ASSOC);
        // Lặp qua kết quả và tạo mảng các đối tượng Comment
        $comments = [];
        foreach ($commentData as $commentItem) {
            $comment = new Comment(
                $commentItem['comment_id'],
                $commentItem['room_id'],
                $commentItem['customer_id'],
                $commentItem['comment_text'],
                $commentItem['rating'],
                $commentItem['created_at']
            );
            $comments[] = $comment;
        }

        return $comments;
    }
    static function deleteCommentById($commentId)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('DELETE FROM comments WHERE comment_id = ?');
        $stmt->execute([$commentId]);
    }
    static function displayStarRating($rating)
    {
        $fullStars = floor($rating);
        $halfStar = $rating - $fullStars >= 0.5;
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                
                echo '&#9733;'; // Full star
            } elseif ($halfStar) {
                echo '&#9733;'; // Half star
                $halfStar = false; // Displayed the half star, so set to false
            } else {
                echo '&#9734;'; // Empty star
            }
        }
    }
}
