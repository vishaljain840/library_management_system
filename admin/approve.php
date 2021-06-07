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
    <title>Book Request</title>
    <style>
        .srch{
            padding-left:850px;
        }

        body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  margin-top:50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.img-circle{
  margin-left:30px;
}
.h:hover{
  color: white;
  width: 300px;
  height: 50px;
  background-color: #00544c;
}
.container{
    height: 700px;
    background-color: black;
    color: white;
    opacity: 0.7;
}
.form-control{
  width: 200px;

}
.Approve{
    margin-left: 400px;

}
    </style>
</head>
<body>
<!-- for sidenav                 -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <div style="color: white; margin-left: 80px;">
                        
                    <?php
                    if(isset($_SESSION['login-user'])){
                      echo "<img class='img-circle profile_img' style ='background-color: white; max-width: 30px; max-height: 30px;'  src='images/".$_SESSION['pic']."' >";
                      echo "<br>";
                      echo "Welcome ".$_SESSION['login_user'];
                    
                    }
             
                ?>

                </div><br><br>

  <div class="h"><a href="add.php">Books</a></div>
  <div class="h"><a href="request.php">Book Request</a></div>
  <div class="h"><a href="issue_info.php">Issue Information</a></div>

</div>
<div id="main">


<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
<div class="container">
<h3 style="text-align: center;">Approve Request</h3>
<form class="Approve" action="" method="post">
<input class="form-control" type="text" name="approved" placeholder="Approve or not" required=""><br>
<input class="form-control"  type="text" name="issue" placeholder="Issue Date yyyy-mm--dd" required=""><br>
<input class="form-control" type="text" name="return" placeholder="Return Date yyyy-mm-dd" required=""><br>
<input type="text" name="tm" class="form-control" placeholder = "Return Date Jun 02, 2021 15:00:00" required="">
<button class="btn btn-default" type="submit" name="submit"  >Approve</button>

</form>

</div>
</div>


<?php
if(isset($_POST['submit']))
{

    mysqli_query($db,"INSERT INTO timer VALUES ('$_SESSION[name]','$_SESSION[bid]','$_POST[tm]');");
    mysqli_query($db,"UPDATE `issue_book` SET `approved` = '$_POST[approved]', `issue`='$_POST[issue]', 
    `return` = '$_POST[return]' WHERE username='$_SESSION[name]' and bid = '$_SESSION[bid]' ;");

    mysqli_query($db,"UPDATE books SET quantity = quantity-1 where bid = '$_SESSION[bid]' ;");

    mysqli_query($db,"UPDATE books SET bcount = bcount+1 where bid = '$_SESSION[bid]' ;");

    $res=mysqli_query($db,"SELECT quantity from books where bid='$_SESSION[bid];'");

    while($row=mysqli_fetch_assoc($res))
    {
        if($row['quantity']==0)
        {
            mysqli_query($db,"UPDATE books SET status='not available' where bid='$_SESSION[bid]';");
        }
    }
    ?>
    <script type="text/javascript">
    alert("Updted Successfully.");
    window.location="request.php"
    </script>
    <?php
}

?>
</body>
</html>
