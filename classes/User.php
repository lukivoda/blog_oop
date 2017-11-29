<?php

class User extends Main{

    public $user_id;
    public $first_name;
    public $last_name;
    public $email;
    public $username;
    public $password;
    public $user_role;

    public static $key ="user_id";
    public static  $table ="users";

    public function insert(){
        $db =self::getConnection();
        try {
            $createQuery = "INSERT INTO users(first_name,last_name,email,username,password,user_role) VALUES (:first_name,:last_name,:email,:username,:password,:user_role)";

            $statement = $db->prepare($createQuery);



            $statement->execute(array(":first_name"=>$this->first_name,":last_name"=>$this->last_name,":email"=>$this->email,":username"=>$this->username,":password"=>$this->password,":user_role"=>"user"));

            if($statement->rowCount()==1){
                return true;
            }




        }catch (PDOException $ex) {
            echo "An error occured ".$ex->getMessage();
        }
    }



    public function render(){
       return  "<tr><td>$this->user_id</td><td>$this->first_name</td><td>$this->last_name</td><td>$this->username</td><td>$this->email</td><td>$this->user_role</td></tr>";
    }



    public function email_exists($email){

        try {
            $db = self::getConnection();
            $statement = $db->query("SELECT * FROM users WHERE email = '$email' ");
            if($statement->rowCount()>0){
                return true;
            }

        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }

    }



    public function username_exists($username){
        $db = self::getConnection();
        try {

            $statement = $db->query("SELECT * FROM users WHERE username = '$username' ");
            if($statement->rowCount()>0){
                return true;
            }

        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }

    }

    public function login(){
        $db = self::getConnection();
        try{
            $query = "Select * from users where username =  '$this->username' ";
            $statement = $db->query($query);
            while($row = $statement->fetch(PDO::FETCH_OBJ)){
                $id =  $row->user_id;
                $username = $row->username;
                $password = $row->password;
                $user_role = $row->user_role;
                if(md5($this->password) == $password){
                    $_SESSION["id"] = $id;
                    $_SESSION["user_role"] = $user_role;
                    $_SESSION["username"] = $username;
                    header('Location: '.$_SERVER['REQUEST_URI']);
                }else{
                    return false;
                }
            }

        }catch(PDOException $ex){
            echo "Error occured ".$ex->getMessage();
        }

}



}
