<?php
    $host="localhost";
    $username="root";
    $password="";
    $database="corecrud";
    
    $conn=mysqli_connect($host,$username,$password,$database);
    if(!$conn){
        die("data base connection couldnt connect");
    }
    ?>