<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/adv_ass/">Headline News </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                <?php
                $categories = $cat->get();//niza
                foreach($categories as $category) {
                    echo  $category->render();
                }

                ?>
                <?php if(!isset($_SESSION["username"])) {?>
                <li><a href="register.php">Register</a></li>
                <?php }else { ?>
                <li><a style="font-weight:bold;color:tomato" href="#"><?php echo $_SESSION["username"] ?></a></li>
                <li><a style="font-weight:bold;color:tomato" href="logout.php">Logout</a></li>
                <?php }?>
                <?php if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin") {?>
                    <li><a href="admin/">Admin</a></li>
                <?php }?>
                <ul class="pull-right nav navbar-nav">

                </ul>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
