<?php 

namespace search;

class Search extends \Db{
    public function searchPosts($search){
        $pattern = "%".$search."%";
        $sql = "SELECT *
                FROM posts 
                WHERE post_title LIKE :pattern OR post_content LIKE :pattern
                ORDER BY post_title ASC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue("pattern", $pattern);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchVideos($search){
        $pattern = "%".$search."%";
        $sql = "SELECT *
                FROM videos 
                WHERE video_title LIKE :pattern OR video_description LIKE :pattern
                ORDER BY video_title ASC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue("pattern", $pattern);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}