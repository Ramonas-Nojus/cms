<?php 

namespace search;

class Search extends \Db{
    public function search($search){
        $pattern = "%".$search."%";
        $sql = "SELECT * FROM posts WHERE post_title LIKE ?  UNION ALL SELECT * FROM videos WHERE video_title LIKE ? ORDER BY post_date DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern, $pattern]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}