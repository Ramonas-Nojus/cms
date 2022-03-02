<?php 

class GetUser extends Db {

    private $username;

    public function __construct($username){
        $this->username = $username;
    }

    public function user(){

        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$this->username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}