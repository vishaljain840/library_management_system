


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
    <title>Student Information</title>
    <style>
        .srch{
            padding-left:1000px;
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
    </style>
</head>
<body>

<!-- for sidenav                 -->

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <div style="color: white; margin-left: 80px;">
                        
                    <?php
                echo "<img class='img-circle profile_img' style ='background-color: white; max-width: 30px; max-height: 30px;'  src='images/".$_SESSION['pic']."' >";
                echo "<br>";
                echo "Welcome ".$_SESSION['login_user'];
                ?>

                </div>

  <a href="profile.php">Profiles</a>
  <a href="books.php">Books</a>
  <a href="request.php">Book Request</a>
  <a href="issue_info.php">Issue Information</a>
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

<!-- end of sidenav---------------------------------- -->
<div class="srch">
<form class="navbar-form" method="post" name="form1">
    

<input type="text" name="search" placeholder=" Student username..." class="form-control" required="">
<button type="submit" name="submit" class="btn btn btn-default" style="background-color: #98c7ce;">
<span class="glyphicon glyphicon-search"></span>

</button>


</form>
</div>
    <h2>List of Students</h2>
    <?php

    if(isset($_POST['submit'])){
    
        // $sql="INSERT into `comments` values('','$_POST[comment]');";
 
        $q=mysqli_query($db,"SELECT first,last,username,roll,email,contact FROM `student` where username like '%$_POST[search]%'");

        if(mysqli_num_rows($q)==0){
            echo "Sorry! No Student found with that username. Try searching again.";

        }
        else{
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color:#98c7ce;'>";
                echo "<th>";  echo "first-name";  echo"</th>";
                echo "<th>";  echo "last-name";  echo"</th>";
                echo "<th>";  echo "username";  echo"</th>";
                echo "<th>";  echo "roll";  echo"</th>";
                echo "<th>";  echo "email";  echo"</th>";
                echo "<th>";  echo "contact";  echo"</th>";
                
            echo "</tr>";
        
            while($row = mysqli_fetch_assoc($q))
            {
                echo "<tr>";
                echo "<td>"; echo $row['first']; echo "</td>";
                echo "<td>"; echo $row['last']; echo "</td>";
                echo "<td>"; echo $row['username']; echo "</td>";
                echo "<td>"; echo $row['roll']; echo "</td>";
                echo "<td>"; echo $row['email']; echo "</td>";
                echo "<td>"; echo $row['contact']; echo "</td>";
        
            }
        
            echo "</table>";

        }

    }
    // if button not pressed
    else{
        

    $res=mysqli_query($db,"SELECT first,last,username,roll,email,contact FROM `student`");

    echo "<table class='table table-bordered table-hover'>";
    echo "<tr style='background-color:#98c7ce;'>";
        echo "<th>";  echo "first-name";  echo"</th>";
        echo "<th>";  echo "last-name";  echo"</th>";
        echo "<th>";  echo "username";  echo"</th>";
        echo "<th>";  echo "roll";  echo"</th>";
        echo "<th>";  echo "email";  echo"</th>";
        echo "<th>";  echo "contact";  echo"</th>";
        
    echo "</tr>";

    while($row = mysqli_fetch_assoc($res))
    {
        echo "<tr>";
        echo "<td>"; echo $row['first']; echo "</td>";
        echo "<td>"; echo $row['last']; echo "</td>";
        echo "<td>"; echo $row['username']; echo "</td>";
        echo "<td>"; echo $row['roll']; echo "</td>";
        echo "<td>"; echo $row['email']; echo "</td>";
        echo "<td>"; echo $row['contact']; echo "</td>";

    }

    echo "</table>";

    }



?>

</body>
</html>


