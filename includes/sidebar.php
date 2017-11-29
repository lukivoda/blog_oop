<div  class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">

                <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" name="submit" class="btn btn-default" >
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>


    <div class="well">
        <?php

        if(isset($_POST["login"])) {
            $errors = [];
            $minimum = 4;
            $maximum = 20;

            $username = $_POST["username"];
            $password = $_POST["password"];

            if ($username == "" || $password == "") {
                $errors[] = "Please fill in the fields!";
            }else {
                $users->username = $username;
                $users->password = $password;
                if(!$users->login()){
                    $errors[] = "Your credentials are not correct!";
                }

            }
        }
        if(!empty($errors)){
            foreach($errors as $error){
                // you can use delimiter also

                echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <strong>Warning! </strong>{$error}
</div> ";
            }


        }





        if(!isset($_SESSION["username"])){
        ?>
        <h4>Login</h4>
        <form method="post" class="form-horizontal">
            <div class="form-group">

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>

            <br><br>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    <button name="login" type="submit" class="btn btn-default">Log in</button>
                </div>
            </div>

        </form>
        <?php }?>
    </div>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $categories = $cat->get();//niza
                    foreach($categories as $category) {
                        echo  $category->render();
                    }
                    

                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>