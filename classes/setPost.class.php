<?php 

class SetPost extends DB {

        private $post_title;
        private $post_category_id;
        private $post_image;
        private $post_image_temp;
        private $post_tags;
        private $post_content;
        private $post_date;
        private $username;
        private $user_id;

        public function __construct($post_title,$post_category_id,$post_image,$post_image_temp,$post_tags,$post_content,$post_date,$username,$user_id){
            $this->post_title = $post_title;
            $this->post_category_id = $post_category_id;
            $this->post_image = $post_image;
            $this->post_image_temp = $post_image_temp;
            $this->post_tags = $post_tags;
            $this->post_content = $post_content;
            $this->post_date = $post_date;
            $this->username = $username;
            $this->user_id = $user_id;
        }

        public function addPost(){
            $sql = "INSERT INTO posts(post_category_id, post_title, post_user, post_user_id,post_image,post_content,post_tags,post_status,post_date) ";
            $sql .= " VALUES('{$this->post_category_id}','{$this->post_title}','{$this->username}','{$this->user_id}','{$this->post_image}','{$this->post_content}', '{$this->post_tags}', 'published', now() ) "; 
            $stmt = $this->connection()->query($sql);
            move_uploaded_file($this->post_image_temp, "../images/$this->post_image" );
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

       
           
        
}