<?php 


class GetPosts extends DB {

    public function posts(){
        
        $sql = "SELECT * FROM posts ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adminPostsByCat($post_category_id){
        
        $sql = "SELECT * FROM posts WHERE post_category_id = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$post_category_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function postsByCat($post_category_id){

        $sql = "SELECT * FROM posts WHERE post_category_id = ? AND post_status = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$post_category_id, 'published']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usersPosts($username){
        $sql = "SELECT * FROM posts WHERE post_user = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}