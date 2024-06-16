
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>

<?php
    session_start();
    if(!isset($_SESSION['email'])){  //checking whether the user is logged out and entering into dashboard
        header("Location: login.php?message='user logged out successfully'");
    }
    ?>

    <?php
        require_once('dbconnection.php');
    ?>

    <table class="table" border="1">
        <thead>
            <th scope="col">id</th>
            <th scope="col">firstname</th>
            <th scope="col">lastname</th>
            <th scope="col">username</th>
            <th scope="col">email</th>
            <th scope="col">operations</th>
        </thead>
        <tbody>
            <?php
                $result= mysqli_query($conn,"select * from  `userdatas`");

                if($result){
                    while($row=mysqli_fetch_assoc($result)){
                        $id=$row['id'];
                        $firstname=$row['firstname'];
                        $Lastname=$row['lastname'];
                        $username=$row['username'];
                        $email=$row['email'];

                        echo "
                            <tr>
                                <td scope='row'>$id</td>
                                <td >$firstname</td>
                                <td >$Lastname</td>
                                <td >$username</td>
                                <td >$email</td>
                                <td>
                                 <button type='submit' name='update'><a href='updateform.php?id=$id'>update</a></button> 
                                  <button type='submit' name='delete'><a href='delete.php?id=$id'>delete</a></button> 
                                 </td>
                            </tr>    
                        ";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>