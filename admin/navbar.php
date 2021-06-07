<?php

session_start();
include "connection.php"



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    $r = mysqli_query($db,"SELECT COUNT(status) as total FROM message where status='no' 
     and sender='student' ;");
    $c = mysqli_fetch_assoc($r);

?>
<nav class="navbar navbar-inverse">
            <div class="container-fluid">
        <div class="navbar-header">
            <!-- <img src="images/logo.jpg" alt=""> -->
            <a class="navbar-brand active">Online Library Management System</a>
            </div>
            
                <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                    <li><a href="feedback.php">FEEDBACK</a></li>
                    
                    <!-- <li><a href="">FEEDBACK</a></li> -->
                </ul>
                <?php
                if(isset($_SESSION['login_user']))
                { ?>
                <ul class="nav navbar-nav">
                <li><a href="student.php">
                    STUDENT-INFORMATION
                    </a></li>
                    <li><a href="fine.php">FINES</a></li>
                    <li><a href="profile.php">
                    Profile
                    </a></li>
                    </ul>

                   
                    
                <ul class="nav navbar-nav navbar-right">
                <li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span>&nbsp <span class="badge bg-green">
                <?php echo $c['total'];  ?></span></a></li>
                    <li>
                        <a href="profile.php">
                        <div style="color: white;">
                        
                    <?php
                echo "<img class='img-circle profile_img' style ='background-color: white; max-width: 30px; max-height: 30px;'  src='images/".$_SESSION['pic']."' >";
                echo " ".$_SESSION['login_user'];
                ?>

                </div>
                        </a>
                    </li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                   
                </ul>
                    <?php
                }
                
                else{?>

                    <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
      
                    <li><a href="registration.php"><span class="glyphicon glyphicon-user">SIGN-UP</span></a></li>
                </ul>
                <?php

                }
                
              

                

                ?>

            </div>
            </nav>
    
</body>
</html>