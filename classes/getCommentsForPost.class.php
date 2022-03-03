<?php 

class GetCommentsForPost extends Db {
    private $post_id;

    public function __construct($post_id){
        $this->post_id = $post_id;
    }

    public function getCommets(){
        $sql = "SELECT * FROM comments WHERE comment_post_id = ? AND comment_status = ? ";
        $sql .= "ORDER BY comment_id DESC ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$this->post_id, 'approved' ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function authorImage($author_id){
        $sql = "SELECT user_image FROM users WHERE user_id = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$author_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}