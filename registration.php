<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>
</head>
    <?php
        require_once("dbconnection.php"); //once he his logged in cannot go to the registration again
        session_start();
        
        if(isset($_POST['register'])){
                   $firstname= $_POST['firstname'];
                    $lastname=$_POST['lastname'];
                    $username=$_POST['username'];
                    $email=$_POST['email'];
                    $password= password_hash($_POST['password'],PASSWORD_DEFAULT); 
                    $confirm_password=$_POST['confirm_password'];

                    $errors=[];
                    //validating the data
                    if(empty($firstname)||empty($lastname)||empty($username)||empty($email)||empty($password)||empty($confirm_password)){
                            array_push($errors,"all the fields are mandatory");
                    }
                    if(strlen($password)<8){
                        array_push($errors,"password filed should equal to 8 char");
                    }
                    if($_POST['password']!==$confirm_password){
                        array_push($errors,"password and confirm password coudnot match");
                    }
                    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                        array_push($errors,"email should be of type email");
                    }
                    //not entering the duplicate values of mail
                    $dupli_check=mysqli_query($conn,"select *from `userdatas` where `email`='$email'");
                    if(mysqli_num_rows($dupli_check)>0){
                        array_push($errors,"alredy exists a mail");
                    }
                    if(count($errors)>0){
                        foreach($errors as $error){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    }
                    else{
                       // die("lsdflsd");
                      $result= mysqli_query($conn,"insert into `userdatas`(`firstname`,`lastname`,`username`,`email`,`password`)values('$firstname','$lastname','$username','$email','$password')");
                        if($result){
                            echo "<div class='alert alert-success'>data inserted succeesfully</div>";
                        }
                        else{
                            die("something went wrong coudnt enter data");
                        }
                    }
        }
    ?>
<body>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" name="firstname" placeholder="firstname" class="form-controll">
            </div>
            <div class="form-group">
                <input type="text" name="lastname" placeholder="lastname" class="form-controll">
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="username" class="form-controll">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="email" class="form-controll">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password" class="form-controll">
            </div>
               <div class="form-group">
                <input type="password" name="confirm_password" placeholder="confirm_password" class="form-controll">
            </div>
            <div class="form-group">
                <input type="submit" name="register" placeholder="password" class="btn btn-primary" value="register">
            </div>
        </form>

</body>
</html>