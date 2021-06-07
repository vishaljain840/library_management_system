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
    <title>Books</title>
    <style>
        .srch{
            padding-left:1000px;
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
    </style>
</head>
<body>
<?php
  $b = mysqli_query($db, "SELECT * FROM `books` order by bcount desc limit 0,3;");
  

?>
  <div style="width: 100%; height: 50px; margin-top: -20px;">
  <div style="background-color: orange; padding: 10px; width: 10%; height: 50; float: left;">
  <h3 style="color: white; margin-top: 0px;">Trending:</h3>
  </div>
  <div style="background-color: #ffcccc; width: 90%; height: 50px; float: left; padding: 10px;">
    <table>
    <?php

    while($b2=mysqli_fetch_assoc($b))
    {
      echo "<tr style='color: black; width: 400px; margin-top: 0px; float: left;'>";
      echo "<td>"; echo "[".$b2['bid']."] &nbsp &nbsp"; echo "</td>";
      echo "<td>"; echo $b2['name']; echo "</td>";
      echo "</tr>";
    }


?>
      <tr style="color: black; width: 400px; margin-top: 0px; float: left;">
      </tr>
    </table>

  </div>
  </div>

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
  <div class="h"><a href="expired.php">Expired</a></div>

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
    

<input type="text" name="search" placeholder="search books..." class="form-control" required="">
<button type="submit" name="submit" class="btn btn btn-default" style="background-color: #98c7ce;">
<span class="glyphicon glyphicon-search"></span>

</button>


</form>
</div>

<!-- request book -->
<div class="srch">
<form class="navbar-form" method="post" name="form1">
    

<input type="text" name="bid" placeholder="Enter Book ID" class="form-control" required="">
<button type="submit" name="submit1" class="btn btn-default" style="background-color: #98c7ce;">
Request

</button>


</form>
</div>
    <h2>List of Books</h2>
    <?php

    if(isset($_POST['submit'])){
    
        // $sql="INSERT into `comments` values('','$_POST[comment]');";
 
        $q=mysqli_query($db,"SELECT * from books where name like '%$_POST[search]%'");

        if(mysqli_num_rows($q)==0){
            echo "Sorry! No books found. Try searching again.";

        }
        else{
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color:#98c7ce;'>";
                echo "<th>";  echo "ID";  echo"</th>";
                echo "<th>";  echo "Book-Name";  echo"</th>";
                echo "<th>";  echo "Authors' name";  echo"</th>";
                echo "<th>";  echo "Edition";  echo"</th>";
                echo "<th>";  echo "Status";  echo"</th>";
                echo "<th>";  echo "quantity";  echo"</th>";
                echo "<th>";  echo "Department";  echo"</th>";
            echo "</tr>";
        
            while($row = mysqli_fetch_assoc($q))
            {
                echo "<tr>";
                echo "<td>"; echo $row['bid']; echo "</td>";
                echo "<td>"; echo $row['name']; echo "</td>";
                echo "<td>"; echo $row['authors']; echo "</td>";
                echo "<td>"; echo $row['edition']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                echo "<td>"; echo $row['department']; echo "</td>";
        
            }
        
            echo "</table>";

        }

    }
    // if button not pressed
    else{
        
    $res=mysqli_query($db,"SELECT * FROM `books` order by `name` asc;");

    echo "<table class='table table-bordered table-hover'>";
    echo "<tr style='background-color:#98c7ce;'>";
        echo "<th>";  echo "ID";  echo"</th>";
        echo "<th>";  echo "Book-Name";  echo"</th>";
        echo "<th>";  echo "Authors' name";  echo"</th>";
        echo "<th>";  echo "Edition";  echo"</th>";
        echo "<th>";  echo "Status";  echo"</th>";
        echo "<th>";  echo "quantity";  echo"</th>";
        echo "<th>";  echo "Department";  echo"</th>";
    echo "</tr>";

    while($row = mysqli_fetch_assoc($res))
    {
        echo "<tr>";
        echo "<td>"; echo $row['bid']; echo "</td>";
        echo "<td>"; echo $row['name']; echo "</td>";
        echo "<td>"; echo $row['authors']; echo "</td>";
        echo "<td>"; echo $row['edition']; echo "</td>";
        echo "<td>"; echo $row['status']; echo "</td>";
        echo "<td>"; echo $row['quantity']; echo "</td>";
        echo "<td>"; echo $row['department']; echo "</td>";

    }

    echo "</table>";



    }
    if(isset($_POST['submit1']))
    {
        if(isset($_SESSION['login_user']))
        {
          $sql1=mysqli_query($db,"SELECT * FROM `books`  WHERE bid='$_POST[bid]' ;");
          $row1=mysqli_fetch_assoc($sql1);
          $count1=mysqli_num_rows($sql1);

          if($count1!=0)
            {

            
            mysqli_query($db,"INSERT INTO issue_book Values('$_SESSION[login_user]',
            '$_POST[bid]','','','');");
                        ?>
                        <script type="text/javascript">
                            window.location="request.php"
            
                        </script>
            
                        <?php
            }else{

              ?>
                        <script type="text/javascript">
                             alert("the book is not available in library");
            
                        </script>
            
                        <?php

            }

        }
        else{

            ?>
            <script type="text/javascript">
                alert("You need to login first");

            </script>

            <?php
        }
    }

?>

</body>
</html>


