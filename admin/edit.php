<?php
 include "navbar.php";
 include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit profile</title>
    <style type="text/css">
        .form-control{
            width: 220px;
            height: 38px;

        }form{
            padding-left: 580px;
        }
        label{
            color:white;
            padding-right: 670px;
        }
        b{
            text-align: center;
            

        }

    </style>
</head>
<body style="background-color: #274a27;">

    <h2 style="text-align: center;color: #fff;">Edit Information </h2>
    <?php
        $sql = "SELECT * FROM admin WHERE username='$_SESSION[login_user]'";
        $result = mysqli_query($db,$sql) or die (mysql_error());

        while ($row = mysqli_fetch_assoc($result))
        {
            $first = $row['first'];
            $last = $row['last'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $contact = $row['contact'];
        }

    ?>
    <div class="profile_info" style="text-align: center;">
        <span style="color: white;">Welcome,</span>
        <h4 style="color: white;"><?php
        echo $_SESSION['login_user'];
        ?></h4>
        

        <form style="text-align: center;" action="" method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="file">
        <label style="text-align: center;"><h4><b>First Name</b></h4></label>
        <input class="form-control" type="text" name="first" value="<?php echo $first ; ?>"><br>
        <label><h4><b>Last Name</b></h4></label>
        <input class="form-control" type="text" name="last" value="<?php echo $last ; ?>"><br>
        <label><h4><b>User Name</b></h4></label>
        <input class="form-control" type="text" name="username" value="<?php echo $username ; ?>"><br>
        <label><h4><b>Password</b></h4></label>
        <input class="form-control" type="text" name="password" value="<?php echo $password ; ?>"><br>
        <label><h4><b>Email</b></h4></label>
        <input class="form-control" type="text" name="email" value="<?php echo $email ; ?>"><br>
        <label><h4><b>Contact</b></h4></label>
        <input class="form-control" type="text" name="contact" value="<?php echo $contact ; ?>"><br>
        <div style="padding-left: 100px">
        <button   class="btn btn-default" type="submit" name="submit">save</button>
        </div>
        <?php

            if(isset($_POST['submit']))
            {

                //copying the image file
                move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name']);

                $first = $_POST['first'];
                $last = $_POST['last'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $pic = $_FILES['file']['name'];

                $sql1 = "UPDATE admin SET     first='$first', last='$last', username='$username',
                 password='$password', email='$email', contact='$contact', pic='$pic' WHERE username='".$_SESSION['login_user']."';";


                if(mysqli_query($db,$sql1))
                {
                    ?>
                    <script type="text/javascript">
                        alert("Saved Successfully");
                    </script>
                    <?php
                }
            }


        ?>
        </form>
    </div>



    
</body>
</html>