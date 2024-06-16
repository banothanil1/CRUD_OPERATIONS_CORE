<?php
    session_start();
    if(isset($_SESSION['email'])){
        session_destroy();
        header('Location: login.php?message="user logged out successfully"');
    }   
?>