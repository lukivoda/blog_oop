<?php

include "includes/header.php"  ?>

<?php include "includes/navigation.php"  ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->
            <?php
            if(isset($_GET["post_id"])) {
                //$sol = "I am good";
                //$id=base64_decode($_GET["post_id"]);
                //$post_id = str_replace($sol,"",$id);
                $post_id = $_GET["post_id"];
                $post = $posts->get($post_id);//niza
                echo $post->render();
            }
            ?>


            <!-- Blog Comments -->

            <!-- Comments Form -->
            <?php
            if (isset($_POST["post_comment"])) {

                if(isset($_SESSION["id"]))  {
                   $comment->comment_post_id = $_GET["post_id"];
                    $comment->comment_content = $_POST["comment_content"];
                    $comment->comment_date = date('d-M-Y H:i:s');
                    $comment->comment_user_id = $_SESSION["id"];
                    $comment->insert();
                    
                }

            }


            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button name="post_comment" type="submit" class="btn btn-primary" >Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->

     <?php

            $rows = $comment->get($post_id);
            foreach ($rows as $row) {


            echo "<div style='border-bottom: 1px solid #ccc;padding-bottom:4px;' class=\"media\" >
                <a class=\"pull-left\" href = \"#\" >
                    <img class=\"media-object\" src = \"http://placehold.it/64x64\" alt = \"\" >
                </a >
                <div class=\"media-body\" >
                    <h4 class=\"media-heading\" > {$row->username}
                        <small>{$row->comment_date} </small>
                    </h4>
                    {$row->comment_content}";
                    if(isset($_SESSION["id"]) && $_SESSION["id"]== $row->user_id  ) {
                    echo "<a href='post/delete/{$row->comment_id}' class='alert alert-danger' style='float: right; padding:5px' >Delete</a> ";
                    }


                    echo "</div >
            </div >";
            }
            ?>


            <?php
            if (isset($_GET["delete"])) {

                $comment->delete($_GET["delete"]);
               header("Location:/adv_ass/post/$row->comment_post_id");
            }



            ?>
          
           


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php   include("includes/sidebar.php")  ?>

    </div>
    <!-- /.row -->
    <?php include "includes/footer.php" ;


    ?>

