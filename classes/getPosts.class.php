<?php 

class GetPosts extends Db {

    public function posts(){

    $query = "SELECT * FROM posts ORDER BY post_id DESC";

    $stmt = $this->connection()->query($query);
    
    return $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }   
}