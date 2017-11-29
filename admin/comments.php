<?php include_once "adminincludes/admin_header.php"?>

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
                    Comments
                </h1>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Post title</th>
                        <th>Comment date</th>
                        <th>Status</th>
                        <th>Comment content</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $all_comments =$comment->get();
                    foreach($all_comments as $comment){
                       echo $comment->render();
                    }

                    ?>

                    </tbody>
                </table>

                <?php
                if (isset($_GET["delete"])) {
                    $delete_id = $_GET["delete"];
                    $comment->delete($delete_id);
                    header("Location:/adv_ass/admin/comments.php");
                }

                ?>


                <?php
                if (isset($_GET["update"])) {
                    $update_comment_id = $_GET["update"];
                    $comment->comment_id = $update_comment_id;
                    $comment->change_status();
                    header("Location:/adv_ass/admin/comments.php");
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