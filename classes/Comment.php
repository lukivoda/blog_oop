<?php


class Comment extends Main
{

    public $comment_id;
    public $comment_user_id;
    public $comment_content;
    public $status;
    public $comment_post_id;
    public $comment_date;

    public static $key = "comment_post_id";
    public static $table = "comments";
    public static $key_comment_id = "comment_id";

    public function render()
    {

        $username = User::get($this->comment_user_id);
        $username = $username->username;

        $post_title = Posts::get($this->comment_post_id);
        $post_title = $post_title->post_title;

        $output = '';
        $output .= "<tr><td>$username</td><td><a href='post/$this->comment_post_id'>$post_title";
        $output .= "</a></td><td>$this->comment_date</td><td>$this->status</td><td>";
        $output .= substr($this->comment_content, 0, 200) . "...";
        $output .= "</td><td>  <a style='color:olive;' href='comments/update/$this->comment_id'>";
        $output .= ($this->status == "approved") ? "Unnaprove" : "Approve";

        $output .= "</a></td><td> <a style='color:tomato;' href='comments/delete/$this->comment_id'>Delete </a></td></tr>";
        return $output;
    }


    public function insert(){

        $db =self::getConnection();
        try {
            //build the query

            //INSERT INTO `comments` (`comment_user_id`, `comment_content`, `status`, `comment_post_id`, `comment_date`) VALUES ('14', 'Lorem ipsum dolor sit amet, consectetur', 'unapproved', '26', '2017-09-11 12:15:38')

            $insert_query = "INSERT INTO comments(comment_user_id,comment_content,status,comment_post_id,comment_date) VALUES(:comment_user_id,:comment_content,:status,:comment_post_id,:comment_date) ";

//prepare the query
            $statement = $db->prepare($insert_query);

//execute the statement
            $statement->execute(array(":comment_user_id" => $this->comment_user_id, ":comment_content" => $this->comment_content,":status" => 'unapproved', ":comment_post_id" => $this->comment_post_id,":comment_date" => $this->comment_date));
            echo  $message_comment = "<div class=\"alert alert-warning\" role=\"alert\">Your comment is waiting  approval!</div>";
            return true;

        } catch (PDOException $ex) {
            echo "Error occured " . $ex->getMessage();
        }
    }
    

    public function change_status() {

        $db = self::getConnection();
        $res = $db->query("SELECT * FROM comments where comment_id = $this->comment_id ");
        $row = $res->fetch(PDO::FETCH_OBJ);
        $status = $row->status;
        if($status == "unapproved"){
            $updateQuery = "UPDATE comments SET status ='approved' WHERE comment_id = $this->comment_id ";
            try {
               $db->exec($updateQuery);
            }catch(PDOException $ex) {
                echo "Error occured ".$ex->getMessage();
            }
        }
        elseif($status == "approved") {
            $updateQuery = "UPDATE comments SET status ='unapproved' WHERE comment_id = $this->comment_id ";
            try {
               $db->exec($updateQuery);
            }catch(PDOException $ex) {
                echo "Error occured ".$ex->getMessage();
            }
        }

        header("Location:comments.php");
        
    }
}