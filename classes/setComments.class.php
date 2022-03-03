<?php 

class SetComments extends Db{

    private $the_post_id;
    private $comment_author;
    private $comment_author_id;
    private $comment_email;
    private $comment_content;

    public function __construct($the_post_id,$comment_author,$comment_author_id,$comment_email,$comment_content){
        $this->the_post_id = $the_post_id;
        $this->comment_author = $comment_author;
        $this->comment_author_id = $comment_author_id;
        $this->comment_email = $comment_email;
        $this->comment_content = $comment_content;
    }

    public function addComments(){
        $sql = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date,author_id)";
        $sql .= "VALUES ('{$this->the_post_id}' ,'{$this->comment_author}', '{$this->comment_email}', '{$this->comment_content }', 'approved',now(),'{$this->comment_author_id}')";
        $stmt = $this->connection()->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}