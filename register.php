<?php include "includes/header.php";?>
    <!-- Navigation -->
<?php include "includes/navigation.php";?>


<?php

 if($_SERVER['REQUEST_METHOD']== 'POST'){

     $errors=[];
     $minimum = 4;
     $maximum =20;

    $errors = [];


     $first_name= trim($_POST["firstname"]);
     $last_name= trim($_POST["lastname"]);
     $username= trim($_POST["username"]);
     $email = trim($_POST["email"]);
     $email = filter_var($email, FILTER_SANITIZE_EMAIL);
     $password = trim($_POST["password"]);
     $password_confirm= trim($_POST["password_confirm"]);



     if($first_name ==" " || $last_name =="" || $username=="" || $email =="" || $password=="" || $password_confirm == ""){
         $errors[] ="All fields should be filled!";
     }else{

     if(strlen($first_name)<$minimum) {
         $errors[] ="Your first name can not be less than than {$minimum} characters";
     }elseif (strlen($first_name)>$maximum){
         $errors[] ="Your first name can not be more than than {$maximum} characters";
     }

     if(strlen($last_name)<$minimum) {
         $errors[] ="Your last name can not be less than than {$minimum} characters";
     }elseif (strlen($last_name)>$maximum){
         $errors[] ="Your last name can not be more than than {$maximum} characters";
     }

         if($users->username_exists($username)){
             $errors[] ="User with that username is already registered in the database!";
         }

         if($users->email_exists($email)){
             $errors[] ="User with that email is already registered in the database!";
         }

         if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
             $errors[] ="The e-mail you entered is not valid!";
         }


         if(strlen($username)<$minimum) {
             $errors[] ="Your username can not be less than {$minimum} characters";
         }elseif (strlen($username)>$maximum){
             $errors[] ="Your username can not be more  than {$maximum} characters";
         }

         

         if (strlen($email)>40){
             $errors[] ="Your email can not be more  than 40 characters";
         }


         if(strlen($password)<$minimum){
             $errors[] ="Your password can not be less than {$minimum} characters";
         }elseif (strlen($password)>$maximum){
             $errors[] ="Your password can not be more than {$maximum} characters";
         }


         if($password != $password_confirm){
             $errors[] ="Your password fields do not match!";
         }

     }


     if(empty($errors)){
         $users->first_name=$first_name;
         $users->last_name=$last_name;
         $users->username=$username;
         $users->email=$email;
         $password =md5($password);
         $users->password =$password;
         $users->user_role = "user";  
         $users->insert();


         $success ="<div class=\"alert alert-success\" role=\"alert\">
  <a href=\"#\" class=\"alert-link\">You are successfully registered!</a>
</div>";



     }





 }


?>


    <!-- Page Content -->
    <div class="container">

    <div class="row">
         <h2 class="text-center">Register</h2>
        <hr>
        <?php

        if(!empty($errors)){
            foreach($errors as $error){
      // you can use delimiter also

                echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  <strong>Warning! </strong>{$error}
</div> ";
            }
        }

        if(isset($success)) echo $success;


        ?>


        <!-- Blog Entries Column -->
        <div class="col-md-offset-4 col-md-4">

            <form class="form-horizontal" action='' method="POST">

                <div class="control-group">
                    <!-- First Name -->
                    <label class="control-label"  for="firstname">First Name</label>
                    <div class="controls">
                        <input  type="text" id="firstname" name="firstname" placeholder="" class="form-control ">
                    </div>
                </div>

                <div class="control-group ">
                    <!-- Last Name -->
                    <label class="control-label"  for="lastname">Last Name</label>
                    <div class="controls">
                        <input type="text" id="lastname" name="lastname" placeholder="" class="form-control ">

                    </div>
                </div>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label"  for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="form-control ">
                            <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- E-mail -->
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">
                            <input type="text" id="email" name="email" placeholder="" class="form-control ">
                            <p class="help-block">Please provide your E-mail</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="form-control ">
                            <p class="help-block">Password should be at least 4 characters</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Password -->
                        <label class="control-label"  for="password_confirm">Password (Confirm)</label>
                        <div class="controls">
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="form-control ">
                            <p class="help-block">Please confirm password</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button name="register" type="submit" class="btn btn-success">Register</button>
                        </div>
                    </div>
            </form>





        </div>



    </div>
    <!-- /.row -->

<?php include "includes/footer.php";?>