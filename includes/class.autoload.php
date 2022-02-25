<?php 

spl_autoload_register("myAutoloader");

function myAutoloader($className){

    $path = "/cms/classes/";

    $extension = "class.php";
    require_once $fullPath = $path.$className.$extension;

}