<?php 

class Posts extends \DB {

    public function getPosts(){
        
        $sql = "SELECT * FROM posts ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function adminPostsByCat($post_category_id){
        
        $sql = "SELECT * FROM posts WHERE post_category_id = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$post_category_id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function postsByCat($post_category_id){

        $sql = "SELECT * FROM posts WHERE post_category_id = ? AND post_status = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$post_category_id, 'published']);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function usersPosts($username){
        $sql = "SELECT * FROM posts WHERE post_user = ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setPost($post_title,$post_category_id,$post_image,$post_image_temp,$post_tags,$post_content,$post_date,$username,$user_id){
        $sql = "INSERT INTO posts(post_category_id, post_title, post_user, post_user_id,post_image,post_content,post_tags,post_status,post_date) ";
        $sql .= " VALUES('{$post_category_id}','{$post_title}','{$username}','{$user_id}','{$post_image}','{$post_content}', '{$post_tags}', 'published', now() ) "; 
        $stmt = $this->connection()->query($sql);
        move_uploaded_file($post_image_temp, "../images/$post_image" );
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getSearch($search){
        $pattern = "%".$search."%";
        $sql = "SELECT * FROM posts WHERE post_tags LIKE ? OR post_title LIKE ? ORDER BY post_id DESC";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$pattern, $pattern]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}