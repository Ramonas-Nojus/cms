<?php 

class SearchPosts extends Db {

    private $search;

    public function __construct($search){
        $this->search = $search;
    }

    public function getSearch(){
        $pattern = "%".$this->search."%";
        $sql = "SELECT * FROM posts WHERE post_tags LIKE ? OR post_title LIKE ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern, $pattern]);
        return $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}