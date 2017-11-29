<?php

class Categories extends Main {
    
    public $cat_id;
    public $cat_title;
    
    public static $key ="cat_id";
    public static  $table ="categories";

   public function render(){
       $output = "<li><a href='";
       $output .=strtolower($this->cat_title);
       $output .= "'>{$this->cat_title}</a></li>";
       return  $output;

     }
}


//"<li><a href='category.php?cat_id={$this->cat_title}'>{$this->cat_title}</a></li>";