<?php

class Videos extends Db {

    public function getVideos(){
        $sql = "SELECT * FROM videos WHERE video_status = 'publish'";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllVideos(){
        $sql = "SELECT * FROM videos";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersVideos($username){
        $sql = "SELECT * FROM videos WHERE video_status = 'publish' AND video_author = :video_author";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue('video_author', $username);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVideosById($video_id){
        $sql = "SELECT * FROM videos WHERE video_status = 'publish' AND video_id = :video_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue('video_id', $video_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdminVideos(){
        $sql = "SELECT * FROM videos";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateViewCount($video_id){
        $sql = "UPDATE videos SET video_views = video_views + 1 WHERE video_id = :video_id ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue("video_id", $video_id);
        $stmt->execute();
    }

    public function setVideo($video_title,$video_image,$video_image_temp,$video_tags,$video_description,$username,$user_id,$video_resources,$video_resources_temp){
        $sql = "INSERT INTO videos(video_title,video_image,video_tags,video_description,video_author,video_author_id,video_resources ,video_status,video_date)";
        $sql .= " VALUES(:video_title,:video_image,:video_tags,:video_description,:username,:user_id,:video_resources,'publish', now() )";
        $stmt = $this->connection()->query($sql);
        $stmt->bindValue("video_title", $video_title);
        $stmt->bindValue("video_image", $video_image);
        $stmt->bindValue("video_tags", $video_tags);
        $stmt->bindValue("video_description", $video_description);
        $stmt->bindValue("username", $username);
        $stmt->bindValue("user_id", $user_id);
        $stmt->bindValue("video_resources", $video_resources);

        move_uploaded_file($video_resources_temp, BASE_URL."/all_videos/$video_resources" );
        move_uploaded_file($video_image_temp, BASE_URL."/images/$video_image" );
    }
    public function updateVideo($video_title,$video_tags,$video_description, $video_id){
        $sql = "UPDATE videos SET video_title = :video_title, video_tags = :video_tags, video_description = :video_description WHERE video_id = :video_id ";
        $stmt = $this->connection()->query($sql);
        $stmt->bindValue("video_title", $video_title);
        $stmt->bindValue("video_tags", $video_tags);
        $stmt->bindValue("video_description", $video_description);
        $stmt->bindValue("video_id", $video_id);
    }

    public function updateVideoImage($video_id, $video_image, $video_image_temp){
        $sql = "UPDATE videos SET video_image = :video_image WHERE video_id = :video_id ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue("video_image", $video_image);
        $stmt->bindValue("video_id", $video_id);
        $stmt->execute();
        move_uploaded_file($video_image_temp, BASE_URL."/images/$video_image" );
    }

    public function deleteVideo($video_id){
        $sql = "DELETE FROM videos WHERE video_id = :video_id ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue("video_id", $video_id);
        $stmt->execute();
    }

}