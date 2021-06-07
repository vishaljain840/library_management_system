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

<!-- end of sidenav---------------------------------- -->

<div class="container">
  <div class="srch">
  <form action="" method="post" name="form1"><br>
  <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
  <input type="text" name="bid" class="form-control" placeholder="Bid" required=""><br>
  <button class="btn btn-default" name="submit" type="submit">Submit</button>
  </form>
  </div>
<h3 style="text-align:center;">Request for book</h3>
<?php
if(isset($_SESSION['login_user']))
{
    $sql = "SELECT student.username,roll,books.bid,name,authors,edition,status FROM student inner join issue_book ON student.username = issue_book.username inner join books on issue_book.bid = books.bid where approved=''";
    $res = mysqli_query($db,$sql);

    if(mysqli_num_rows($res)==0)
    {
      echo "<h2><b>";
      echo "There's no pending request";
      echo "</h2><b>";
    }
    else{
      echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color:#98c7ce;'>";
      
                echo "<th>";  echo "Student Username";  echo"</th>";
                echo "<th>";  echo "Roll No";  echo"</th>";
                echo "<th>";  echo "BID";  echo"</th>";
                echo "<th>";  echo "Book Name";  echo"</th>";
                echo "<th>";  echo "Author's name";  echo"</th>";
                echo "<th>";  echo "edition";  echo"</th>";
                echo "<th>";  echo "Status";  echo"</th>";
      
            echo "</tr>";
        
            while($row = mysqli_fetch_assoc($res))
            {
                echo "<tr>";
                echo "<td>"; echo $row['username']; echo "</td>";
      
                echo "<td>"; echo $row['roll']; echo "</td>";
                echo "<td>"; echo $row['bid']; echo "</td>";
                echo "<td>"; echo $row['name']; echo "</td>";
                echo "<td>"; echo $row['authors']; echo "</td>";
                echo "<td>"; echo $row['edition']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
                echo "</tr>";
            }
      
      
            echo "</table>";
      

    }
}
else{
  ?>
  <script type="text/javascript">
  alert("You need to login to see requests")
  </script>

  <?php
}

if(isset($_POST['submit']))
{
  $_SESSION['name'] = $_POST['username'];
  $_SESSION['bid'] = $_POST['bid'];
  ?>

  <script type="text/javascript">
  window.location="approve.php";
  </script>
<?php
}





?> 
</div>
</body>
</html>
