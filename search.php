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

            if(isset($_POST["submit"])){

                if(strlen($_POST["search"])<3){
                    echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <strong>Warning! </strong> Your search query can not be less than 3 characters!
</div> ";

                }else {

                    $posts->post_search = trim($_POST["search"]);
                    $posts = $posts->search();
                    foreach ($posts as $post) {
                        echo $post->render();
                    }

                }

            }
            ?>




            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

<?php include "includes/footer.php";?>