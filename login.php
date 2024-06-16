<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php
        require_once('dbconnection.php');
        if(isset($_GET['message'])){//showing the message when user loggedout successfully
            $message=$_GET['message'];
            echo "<div class='alert alert-success'>$message</div>";
        }
        session_start(); //once he his logged in cannot go to the login again
        if(isset($_SESSION['email'])){
            header("Location: dashboard.php");
        }

        if(isset($_POST['login'])){
            $email=$_POST['email'];
            $password= $_POST['password']; 
            $errors=[];
            //validating the data
            if(empty($email)||empty($password)){
                    array_push($errors,"all the fields are mandatory");
            }
            if(strlen($password)<8){
                array_push($errors,"password filed should equal to 8 char");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"email should be of type email");
            }
            else{
                 $result=mysqli_query($conn,"select * from `userdatas` where `email`='$email'");
                   $information= mysqli_fetch_array($result,MYSQLI_ASSOC);
                   if(password_verify($password,$information['password'])){
                            session_start();
                            $_SESSION['email']=$email;
                            echo "<div class='alert alert-success'>your successfully logged in</div>";        
                            header("Location: dashboard.php");
                   }
                   else{
                    echo "<div class='alert alert-danger'>entered password is invalid</div>";
                     }
             }
        }
    ?>
   <form action="login.php" method="post"> 
            <div class="form-group">
            <input type="email" name="email" placeholder="email" class="form-controll">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password" class="form-controll">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="login" placeholder="login" class="btn btn-primary">
            </div>
</form>
</body>
</html>