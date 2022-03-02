<?php 

class GetUsersPosts extends Db {

    private $username;

    public function __construct($username){
        $this->username = $username;
    }

    public function usersPosts(){
        $sql = "SELECT * FROM posts WHERE post_user = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$this->username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}