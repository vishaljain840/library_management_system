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
.scroll{
    width: 100%;
    height: 520px;
    overflow: auto;

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
  <div class="h"><a href="expired.php">Expired List</a></div>

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
</div>
<div class="container">
<h2 style="text-align: center;">Information of Borrowed Books</h2>
<?php
    $c = 0;

    if(isset($_SESSION['login_user']))
    {
        $sql ="SELECT student.username,roll,books.bid,
        name,authors,edition,issue_book.issue,issue_book.return FROM student inner join
        issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE
        issue_book.approved = 'Yes' ORDER BY `issue_book`.`return` ASC";

        $res=mysqli_query($db,$sql);

        echo "<div class='scroll'>";
        echo "<table style='color: white' class='table table-bordered table-hover'>";
        echo "<tr style='background-color:#98c7ce;'>";

            
            echo "<th>";  echo "Student Username";  echo"</th>";
            echo "<th>";  echo "Roll No";  echo"</th>";
            echo "<th>";  echo "BID";  echo"</th>";
            echo "<th>";  echo "Book Name";  echo"</th>";
            echo "<th>";  echo "Author's name";  echo"</th>";
            echo "<th>";  echo "edition";  echo"</th>";
            echo "<th>";  echo "Issue Date";  echo"</th>";
            echo "<th>";  echo "Return Date";  echo"</th>";
            
  
        echo "</tr>";
    
        while($row = mysqli_fetch_assoc($res))
        {
            $d=date("Y-m-d");
            if($d > $row['return'])
            {
                ?>
                <script type="text/javascript">alert("ucking");</script>
                <?php
                $c=$c + 1;
                $var='<p style="color:yellow; background-color: red;">expired</p>';
                mysqli_query($db,"UPDATE issue_book SET approved='$var' where `return`='$row[return]' and 
                approved='Yes' limit $c; ");

                echo $d."<br>";
            }
            echo $d."</br>";
            echo "<tr>";
            echo "<td>"; echo $row['username']; echo "</td>";
  
            echo "<td>"; echo $row['roll']; echo "</td>";
            echo "<td>"; echo $row['bid']; echo "</td>";
            echo "<td>"; echo $row['name']; echo "</td>";
            echo "<td>"; echo $row['authors']; echo "</td>";
            echo "<td>"; echo $row['edition']; echo "</td>";
            echo "<td>"; echo $row['issue']; echo "</td>";
            echo "<td>"; echo $row['return']; echo "</td>";
            echo "</tr>";
        }
  
        
        echo "</table>";
        echo "</div>";
  
    
    }else{
        ?>

        <script type="text/javascript">
        alert("please login first");
        </script>

        <?php
    }

?>
</div>
</body>
</html>