<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php
        require_once('dbconnection.php');

        $id = $_GET['id'];
        if (isset($_POST['update'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_confirm = $_POST['confirm_password'];

            $errors = [];
            if (empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
                array_push($errors, "All fields are mandatory to enter");
            }
            if ($password !== $password_confirm) {
                array_push($errors, "Password and confirm password do not match");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password length should be at least 8 characters");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email should be of type email only");
            }

            // Check for duplicate email
            $dupli_check = "select * from `userdatas` where email='$email' and id != '$id'";
            $dupli_result = mysqli_query($conn, $dupli_check);

            if (mysqli_num_rows($dupli_result) > 0) {
                array_push($errors, "Email already exists");
            }

            if (count($errors) > 0) {
                //die($errors);
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                //die(password_hased);
                //query to update the record
                $query = "update `userdatas` set `firstname`='$firstname', `lastname`='$lastname', `username`='$username', `email`='$email', `password`='$password_hashed' where `id`='$id'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo "<div class='alert alert-success'>Data has been successfully updated</div>";
                    header("Location: dashboard.php");//re
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Data has not been successfully updated</div>";
                }
            }
        }
    ?>

    <form action="updateform.php?id=<?php echo $id; ?>" method="post">
        <div class="form-group">
            <input type="text" name="firstname" class="form-control" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="text" name="lastname" class="form-control" placeholder="Last Name">
        </div>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
        </div>
        <div class="form-group">
            <input type="submit" name="update" class="btn btn-primary" value="Update">
        </div>
    </form>
</body>
</html>