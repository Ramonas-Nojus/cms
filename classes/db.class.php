<?php 

class Db {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "cms";

    public function connection(){
        $dsn = "mysql:host=".$this->host.";dbName=".$this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        return $pdo;
    }
}