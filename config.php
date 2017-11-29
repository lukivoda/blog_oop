<?php  ob_start();
session_start();
include("includes/params.php");

function __autoload($ime_na_klasa){
    require_once "classes/$ime_na_klasa.php";
}

$cat = new Categories();
$posts =   new Posts();
$comment = new Comment();
$users = new User;
?>