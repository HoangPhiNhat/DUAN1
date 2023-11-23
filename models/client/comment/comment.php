<?php
 class Comment
{
    private $id;
    private $room_id;
    private $user_name;
    private $comment_text;
    private $created_at;

    public function __construct($id, $room_id, $user_name, $comment_text, $created_at)
    {
        $this->id = $id;
        $this->room_id = $room_id;
        $this->user_name = $user_name;
        $this->comment_text = $comment_text;
        $this->created_at = $created_at;
    }
   


}
