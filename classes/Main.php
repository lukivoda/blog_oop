<?php

class Main extends Database
{

    static $table;
    static $key;
    static $number_of_rows;


    public static function get($id = null) {

        $db = self::getConnection();
        $table = static::$table;
        $key_k = static::$key;


        try {
            if ($table != "comments") {
                if ($id != null) {

                    $statement = $db->query("SELECT * FROM $table WHERE $key_k = $id ");
                    $statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
                    self::$number_of_rows = 1;
                    $row = $statement->fetch();
                    return $row;
                }
            }
            $rows = [];
            $statement = ($id == null || $table != "comments") ? $db->query("SELECT * FROM $table") : $db->query("SELECT comments.comment_id,comments.comment_content,comments.comment_date,comments.status,users.username,users.user_id,posts.post_id from comments join users on comments.comment_user_id = users.user_id join posts on posts.post_id = comments.comment_post_id where posts.post_id = $id AND comments.status ='approved' ");
            $statement->setFetchMode(PDO::FETCH_CLASS, get_called_class());
            while ($row = $statement->fetch()) {
                $rows[] = $row;
            }
            return $rows;

        } catch (PDOException $ex) {
            echo "Error occured " . $ex->getMessage();
        }
    }

    public function delete($id){

        $db = self::getConnection();
        $table = static::$table;
        $key_k = ($table!="comments")?static::$key:static::$key_comment_id ;

        try {

            $deleteQuery = "DELETE from $table  WHERE $key_k = :id";

            $statement = $db->prepare( $deleteQuery );

            $statement->execute(array(":id"=>$id));

            if($statement){
               return true;
            }
            
        }catch (PDOException $ex) {
            echo "An error occured ".$ex->getMessage();
        }
    }
  
}

