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
                        Users
                    </h1>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>User_id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>User_role</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $all_users=$users->get();
                        //print_r($all_users);
                       foreach($all_users as $user){
                          echo $user->render();
                       }

                        ?>

                        </tbody>
                    </table>





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