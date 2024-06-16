<?php
  require_once('dbconnection.php');
    if(isset($_GET['id'])){
        $id=$_GET['id'];
         $result=mysqli_query($conn, "delete from `userdatas` where `id` = '$id'");
         if($result){
            header('Location: dashboard.php');//redirecting to the dashboard once deleted
         }
         else{
            echo "<div class='alert alert-danger'>could not delete the data</div>";
         }
    }
?>