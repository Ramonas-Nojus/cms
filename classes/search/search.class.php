<?php 

namespace search;

class Search extends \Db{
    public function search($search){
        $pattern = "%".$search."%";
        $sql = "SELECT * FROM videos INNER JOIN  posts ON videos.video_title LIKE CONCAT('%',posts.post_title,'%') WHERE posts.post_title LIKE ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}