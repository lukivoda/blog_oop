
<?php include_once "adminincludes/admin_header.php";?>
<?php

if(isset($_POST["submit"])) {
    $post_title = $_POST["title"];
    $post_date = date('d-M-Y H:i:s');
    $post_author = $_POST["author"];
    $post_cat = $_POST["cat"];
    $post_keywords = $_POST["keywords"];


    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $image_size = $_FILES["image"]["size"];
    $image_type = $_FILES['image']['type'];
    $post_content = $_POST["post_content"];

    $allowed_extensions = array("image/jpeg","image/gif","image/png");


    if ($post_title == "" || $post_author == "" || $post_cat == "" || $post_keywords == "" || $post_content =="" || $image_name == "") {
        $error = "<div class='alert alert-danger' role='alert'>All fields should be filled!</div>";


    } elseif (empty($image_name)) {
        $error = "<div class='alert alert-danger' role='alert'>Upload an image!</div>";

    } elseif ($image_size > 1048567) {
        $error = "<div class='alert alert-danger' role='alert'>Image size should be less than 1Mb!</div>";
    }elseif(!in_array($image_type,$allowed_extensions)){
        $error = "<div class='alert alert-danger' role='alert'>Only jpg, gif, and png files are allowed. </div>";
    } else {

        $posts->category_id = $post_cat;
        $posts->post_title = $post_title;
        $posts->post_date = $post_date;
        $posts->post_author = $post_author;
        $posts->post_keywords = $post_keywords;
        $posts->post_image = $image_name;
        $posts->post_content = $post_content;
        move_uploaded_file($image_tmp, "images/$image_name");
        if($posts->insert()){
            $success = "<div class='alert alert-success' role='alert'>Your post is successfully inserted!!</div>";
        }else{
            $error = "<div class='alert alert-danger' role='alert'>Post is not inserted!Try again!</div>";

        }


    }


}

?>





    <div id="wrapper">

    <!-- Navigation -->
<?php include_once "adminincludes/admin_top_nav.php"?>

<?php include_once "adminincludes/admin_sidebar_nav.php"?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Insert Post
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-lg-12">
                    <?php


                    if(isset($error)){
                        echo $error;
                    }
                    if(isset($success)){
                        echo $success;
                    }

                    ?>
                    <form method="post" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">
                            <label for="title" class="control-label col-sm-2" >Post title:</label>
                            <div class="col-sm-8">
                            <input  type="text" name="title" class="form-control " id="title" >
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-2" for="author">Post Author:</label>
                            <div class="col-sm-8">
                            <input type="text" name="author" class="form-control" id="author" placeholder="post author">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="author">Post Category:</label>
                            <div class="col-sm-8">
                            <select name="cat" class="form-control">
                                <option value=""> Select category:</option>
                                <?php
                                $cat_all = $cat->get();
                                foreach($cat_all as $cat) {
                                echo  "<option value='{$cat->cat_id}' >{$cat->cat_title}</option>";
                                }
                                ?>
                            </select>
                                </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-2" for="keywords">Post Keywords:</label>
                            <div class="col-sm-8">
                                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="keywords">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="image">Upload Image</label>
                            <div class="col-sm-8">
                                <input type="file" name= "image" id="image">
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="control-label col-sm-2" for="post_content">Post Content:</label>
                            <div class="col-sm-8">
                                <textarea name="post_content" class="form-control" ></textarea>
                            </div>
                        </div>


                        <div class=" insert col-sm-offset-2 col-sm-6">
                            <button name="submit" type="submit" class="btn btn-default">Insert</button>
                        </div>


                    </form>



                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

<?php include_once "adminincludes/admin_footer.php"?>



