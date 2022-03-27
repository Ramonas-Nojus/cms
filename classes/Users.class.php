<?php 

class Users extends Db {


    public function getUser($username){

        $sql = "SELECT * FROM users WHERE username = ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function searchUsers($search){
        $pattern = "%".$search."%";
        $sql = "SELECT * FROM users WHERE username LIKE ? OR user_firstname LIKE ? OR user_lastname LIKE ?  OR user_full_name LIKE ? ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern,$pattern,$pattern,$pattern]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usersActivity($username){
        $sql = "SELECT * FROM posts WHERE post_user = ? UNION ALL  SELECT * FROM videos  WHERE video_author = ? ORDER BY post_date DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$username,$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}