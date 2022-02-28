<?php 
class UsersSearch extends Db {
    private $search;

    public function __construct($search){
        $this->search = $search;
    }

    public function getUsers(){
        $pattern = "%".$this->search."%";
        $sql = "SELECT * FROM users WHERE username LIKE ? OR user_firstname LIKE ? OR user_lastname LIKE ?  OR user_full_name LIKE ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern,$pattern,$pattern,$pattern]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}