<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3css"> -->
    <style type="text/css">
    nav{
    float: right;
    word-spacing: 20px;
    line-height: 80px;
    padding: 20px;
}

nav li{
    display: inline-block;
}
    </style>
    <title>Online Library Management System</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <div class="wrapper">

        <header>
            <div class="logo">
            <img src="images/logo.jpg" alt="">
            <h1 style=" color: white;">Online Library Management System</h1>
            </div>

            <?php
            if(isset($_SESSION['login_user']))
            {?>
                <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                    <li><a href="student_login.php">LOGOUT</a></li>
 
                    <li><a href="feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>
            <?php
            }
            
            else{
                ?>
                <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                    <li><a href="admin_login.php">ADMIN-LOGIN</a></li>
 
                    <li><a href="feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>


                <?php
           

            }
            
            ?>

        

            

        </header>
        <section>
            <div class="sec_img">
            <br>
            <div class="box">
                <br><br><br><br>
                <h1 style="text-align: center; font-size: 35px;" >Welcome To Library</h1><br>
                <h1 style="text-align: center; font-size: 25px;">Opens at 09:00</h1><br>
                <h1 style="text-align: center; font-size: 25px;">Closes at 15:00</h1>

            </div>
        </div>
    

        </section>

         </div>
         <?php
           include "footer.php";
           ?>
    
</body>
</html>