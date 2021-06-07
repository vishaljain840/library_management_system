<?php
include "connection.php";
include "navbar.php";



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
section{
    margin: -20px;
}

</style>
</head>
<body>
    <!-- <header style="height: 100px"> -->
        

    <!-- </header> -->

    <section>
        <div class="log_img">
            <br><br><br>
            <div class="box1">
                <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Library Management System</h1><br>
                <h1 style="text-align: center; font-size: 25px; ">User Login Form</h1>
                <form name="login" action="" method="post" >
                    
                    <div class="login">
                    <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                    <input  class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                    <input type="submit" class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px;">
                </div>
                
                <p style="color: white; margin: auto 50px;">
                    
                    <a style="color: white;" href="update_password.php">Forgot password?</a> 
                    New to this website?<a style="color:white;"href="registration.html">Sign up</a></p>
                    </form>
            </div>

        </div>

    </section>

    <?php

    if(isset($_POST['submit']))
    {
        $count = 0;
        $res=mysqli_query($db,"SELECT * FROM `student` where username='$_POST[username]'
         and password='$_POST[password]'  ;");
        $count=mysqli_num_rows($res);


        if($count==0)
        {
            ?>
            <script type="text/javascript">
            alert("The username and password does not match.");

            </script>
            <?php
        }
        else{
            $_SESSION['login_user'] = $_POST['username'];
            $_SESSION['pic'] = $row['pic'];

            ?>
               <script type="text/javascript">
               window.location="index.php";
               </script>
            <?php
        }

    }


?>
</body>
</html>