
<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- First Blog Post -->
            <?php
            if(isset($_GET["cat_id"])) {
                //echo $_GET["cat_id"];//local/europe....
                $cat_id= ucfirst($_GET["cat_id"]);
                $categories = $cat->get();//niza
               foreach ($categories as $category){
                   if($category->cat_title == $cat_id  ){
                       $cat_id = $category->cat_id;
                   }
               }

                $cat_posts = $posts->get_posts_by_category_id($cat_id);
                foreach($cat_posts as $cat_post){
                echo $cat_post->render();
                }

            }else{
                header("Location:/adv_ass/");
            }
            ?>




            <!-- Pager -->


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

<?php include "includes/footer.php";?>