<?php

class Posts extends Main {

    public $post_id;
    public $category_id;
    public $post_author;
    public $post_keywords;
    public $post_title;
    public $post_date;
    public $post_image;
    public $post_content;

    public $po_strana =4;
    public $vkupno_postovi;
    public $vkupno_strani;

    public $post_search;

    public static $key ="post_id";
    public static  $table ="posts";
  


    public function get_posts_by_category_id($id){
        try {
            $db = self::getConnection();
            $rows = [];
            $statement = $db->query("SELECT * FROM posts WHERE category_id = $id ");
            $statement->setFetchMode(PDO::FETCH_CLASS,"Posts");
            while ($row = $statement->fetch()) {
                $rows[] = $row;
            }

            return $rows;
        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }
    }


    public function insert(){
        $db =self::getConnection();
        try {
            //build the query
            $insert_query = "INSERT INTO posts(category_id,post_title,post_date,post_author,post_keywords,post_image,post_content) VALUES( :category_id,:post_title,:post_date,:post_author,:post_keywords,:post_image,:post_content) ";

//prepare the query
            $statement = $db->prepare($insert_query);

//execute the statement
            $statement->execute(array(":category_id" => $this->category_id, ":post_title" => $this->post_title,":post_date" => $this->post_date, ":post_author" => $this->post_author,":post_keywords" => $this->post_keywords,":post_image" => $this->post_image,":post_content" => $this->post_content));

            return true;

        } catch (PDOException $ex) {
            echo "Error occured " . $ex->getMessage();
        }
   }



    public function update() {

        $db = self::getConnection();

        try{


        $updateQuery = "UPDATE posts SET category_id = :category_id,post_title = :post_title,post_date = :post_date,post_author = :post_author,post_keywords = :post_keywords,post_image = :post_image,post_content = :post_content  WHERE post_id = :post_id";

        $statement = $db->prepare($updateQuery);

        $statement->execute(array(":category_id" => $this->category_id, ":post_title" => $this->post_title,":post_date" => $this->post_date, ":post_author" => $this->post_author,":post_keywords" => $this->post_keywords,":post_image" => $this->post_image,":post_content" => $this->post_content,":post_id" => $this->post_id));

        if ($statement->rowCount() === 1) {
            return true;
        } else {
            return false;
        }




    }catch (PDOException $ex){
echo "An error occured ".$ex->getMessage();
}
}


     //Render posts
    public function render() {


        //<h2>
        //<a href='post.php?post_id={$this->post_id}'>{$this->post_title}</a>
            //</h2>


        //echo
        //$sol = "I am good";
        //$id=base64_encode($this->post_id.$sol);
       $output = "
             <h2>
        <a href='post/";

        $output .=$this->post_id;

        $output .="'>{$this->post_title}</a>
        </h2>
            <p class='lead'>
                by <a href='#'>{$this->post_author}</a>
            </p>
            <p><span class='glyphicon glyphicon-time'></span> Posted on:  {$this->post_date}</p>
            <hr>
            <img class='img-responsive' src='admin/images/{$this->post_image}' alt=''>
            <hr>";?>
            
        <?php $output .=(static::$number_of_rows!=1)?"<p>".substr($this->post_content,0,250)."
            .... </p> <a class='btn btn-primary' href='post/{$this->post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
            <hr>":"<p>".$this->post_content."</p> <hr>";

            return $output;
    }


    //Render Admin posts
    public function render_admin(){

        $category_title = Categories::get($this->category_id);
        $category_title =$category_title->cat_title;

        $output = "";
        $output .=  "<tr><td>$this->post_id</td><td>$category_title</td><td><a href='post/$this->post_id'>$this->post_title</a></td><td>$this->post_date</td><td>$this->post_author</td><td><img width='55' src='images/$this->post_image'></td><td>";
        //$result = $user->connect->query("SELECT cat_title from categories where cat_id = {$row->category_id}");
        //$row1=$result->fetch_object();
        //echo $row1->cat_title;
        $output .= substr($this->post_content,0,20). "...</td><td><a style='color:tomato' href='posts/delete/$this->post_id'>delete</a>&nbsp; <a style='color:olive' href='update/post/$this->post_id'>update</a></td></tr>";
        
        return $output;
    }


    public function search(){
         //$result= $this->connect->query("SELECT * FROM $table WHERE post_title LIKE '%$search%' OR post_keywords LIKE '%$search%' OR post_content LIKE '%$search%'  ");$this->post_search
        $db = self::getConnection();
        try {
            
                $search_query = "SELECT * FROM posts WHERE post_title LIKE :search OR post_keywords LIKE :search OR post_content LIKE :search  ";
                $rows = [];
                $statement = $db->prepare($search_query);
                $statement->execute(array(":search" => "%$this->post_search%"));
                $statement->setFetchMode(PDO::FETCH_CLASS, "Posts");
                while ($row = $statement->fetch()) {
                    $rows[] = $row;
                }
                return $rows;
         
        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }

    }
    
    
    public function vkupno_strani(){
        try {
            
            $db = self::getConnection();
          
            $statement = $db->query("SELECT * FROM posts");
            $statement->fetch(PDO::FETCH_OBJ);
            $this->vkupno_postovi = $statement->rowCount();
            $this->vkupno_strani = ceil($this->vkupno_postovi/$this->po_strana);
            return $this->vkupno_strani;
        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }
    }




    public function pagination(){

        try {
            $db = self::getConnection();
            $strana = isset($_GET["strana"])? ($_GET["strana"]-1):0;
            $page_index = $this->po_strana * $strana;

            $rows = [];
            $statement = $db->query("SELECT * FROM posts ORDER by post_date DESC limit  $page_index,$this->po_strana ");
            $statement->setFetchMode(PDO::FETCH_CLASS,"Posts");
            while ($row = $statement->fetch()) {
                $rows[] = $row;
            }

            return $rows;
        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }



    }



}