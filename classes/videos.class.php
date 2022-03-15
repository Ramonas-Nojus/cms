<?php

class Videos extends Db {

    public function getVideos(){
        $sql = "SELECT * FROM videos WHERE video_status = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute(['publish']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllVideos(){
        $sql = "SELECT * FROM videos";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersVideos($username){
        $sql = "SELECT * FROM videos WHERE video_status = ? AND video_author = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute(['publish', $username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVideosById($video_id){
        $sql = "SELECT * FROM videos WHERE video_status = ? AND video_id = ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute(['publish', $video_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAdminVideos(){
        $sql = "SELECT * FROM videos";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateViewCount($video_id){
        $sql = "UPDATE videos SET video_views = video_views + 1 WHERE video_id = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$video_id]);
    }

    public function setVideo($video_title,$video_image,$video_image_temp,$video_tags,$video_description,$username,$user_id,$video_resources,$video_resources_temp){
        $sql = "INSERT INTO videos(video_title,video_image,video_tags,video_description,video_author,video_author_id,video_resources ,video_status,video_date)";
        $sql .= " VALUES('{$video_title}','{$video_image}','{$video_tags}','{$video_description}','{$username}','{$user_id}','{$video_resources}','publish', now() )";
        $stmt = $this->connection()->query($sql);
        move_uploaded_file($video_resources_temp, "../all_videos/$video_resources" );
        move_uploaded_file($video_image_temp, "../images/$video_image" );
    }
    public function updateVideo($video_title,$video_tags,$video_description, $video_id){
        $sql = "UPDATE videos SET video_title='{$video_title}', video_tags='{$video_tags}', video_description='{$video_description}' WHERE video_id = $video_id ";
        $this->connection()->query($sql);
    }

    public function updateVideoImage($video_id, $video_image, $video_image_temp){
        $sql = "UPDATE videos SET video_image = ? WHERE video_id = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$video_image, $video_id]);
        move_uploaded_file($video_image_temp, "../images/$video_image" );
    }

    public function deleteVideo($video_id){
        $sql = "DELETE FROM videos WHERE video_id = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$video_id]);
    }

}