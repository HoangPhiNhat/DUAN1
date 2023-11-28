<?php
class Comment
{
    public $comment_id;
    public $customer_id;
    public $room_id;
    public $comment_text;
    public $created_at;

    public function __construct($comment_id, $room_id, $customer_id, $comment_text, $created_at)
    {
        $this->comment_id = $comment_id;
        $this->room_id = $room_id;
        $this->customer_id = $customer_id;
        $this->comment_text = $comment_text;
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
        $db = DB::getInstance(); // DB::getInstance() làm việc với cơ sở dữ liệu của bạn, thay thế nó bằng cách phù hợp

        // Thực hiện truy vấn
        $query = "SELECT * FROM comments";
        $statement = $db->query($query);

        // Lấy kết quả và trả về một mảng các đối tượng Comment
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    static function getCommentsByRoomId($roomId) {
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
}
