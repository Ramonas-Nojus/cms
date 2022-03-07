<?php

class Videos extends Db {

    public function getVideos(){
        $sql = "SELECT * FROM videos";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}