<?php 


class GetPostsByCat extends DB {
    private $post_category_id;

    public function __construct($post_category_id){
        $this->post_category_id = $post_category_id;
    }

    public function adminPostsByCat(){
        
        $sql = "SELECT * FROM posts WHERE post_category_id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$this->post_category_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postsByCat(){

        $sql = "SELECT * FROM posts WHERE post_category_id = ? AND post_status = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$this->post_category_id, 'published']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}