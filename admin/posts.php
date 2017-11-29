<?php include_once "adminincludes/admin_header.php"?>

    <div id="wrapper">

    <!-- Navigation -->
<?php include_once "adminincludes/admin_top_nav.php"?>

<?php include_once "adminincludes/admin_sidebar_nav.php";?>

    <div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Posts
                </h1>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Post_id</th>
                        <th>Category</th>
                        <th>Post title</th>
                        <th>Post date</th>
                        <th>Post author</th>
                        <th>Post image</th>
                        <th>Post content</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $rows =$posts->get();
                    
                    foreach($rows as $row){
                       echo $row->render_admin();
                    }

                    ?>

                    </tbody>
                </table>

                <?php
                if (isset($_GET["delete"])) {
                    $delete_post_id = $_GET["delete"];
                    $posts->delete($delete_post_id);
                    header("Location:/adv_ass/admin/posts.php");
                }



                ?>



            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

<?php include_once "adminincludes/admin_footer.php"?>