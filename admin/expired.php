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
            padding-left:80%;
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
    margin-top: -30px;
    width: 80%;
}
.form-control{
  width: 200px;

}
.scroll{
    width: 100%;
    height: 520px;
    overflow: auto;

}
#main{
  transition: margin-left .5s;
  padding-left: 10px;
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

<?php
    if(isset($_SESSION['login_user']))
    {

        ?>
       <div style="float: left; padding: 25px;">
       <form method="post" action="">
  <button name="submit2" type="submit" class="btn btn-default" style="background-color: #06861a; color: #d6d139;">RETURNED</button> &nbsp&nbsp
  <button name="submit3" type="submit" class="btn btn-default" style="background-color: #ef0e32;  color: #d6d139;">EXPIRED</button>
  </form>
  </div>
        <div class="srch">
        <form action="" method="post" name="form1"><br>
        <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
        <input type="text" name="bid" class="form-control" placeholder="Bid" required=""><br>
        <button class="btn btn-default" name="submit" type="submit">Submit</button>
        </form>
         </div>

        <?php
        if(isset($_POST['submit']))
        {
          $res = mysqli_query($db, "SELECT * FROM `issue_book` where
           username='$_POST[username]' and bid='$_POST[bid]'");

          while($row = mysqli_fetch_assoc($res))
          {
            $d = strtotime($row['return']);
            $c = strtotime(date("Y-m-d"));
            $diff= $c - $d;

            if($diff>=0)
            {
              $day = floor($diff/(60*60*24));
              $fine = $day*.10;

            }
          }
          $x = date("Y-m-d");
          mysqli_query($db,"INSERT INTO `fine` VALUES ('$_POST[username]', '$_POST[bid]', '$x',
           '$day', '$fine', 'not paid');");


            $var1='<p style="color:yellow; background-color: green;">Returned</p>';
            mysqli_query($db,"UPDATE issue_book SET approved='$var1' where username= '$_POST[username]'
            and bid='$_POST[bid]' ");

            if(mysqli_query($db, "UPDATE books SET quantity = quantity+1 where bid='$_POST[bid]' "))
            {
                ?>
                <script type="text/javascript">pass;</script>

                <?php
            }
        }
    }
?>
<!-- <h2 style="text-align: center;">Date expired list</h2> --><br>

<?php
    $c = 0;
 
    if(isset($_SESSION['login_user']))
    {
      $ret='<p style="color:yellow; background-color: green;">Returned</p>';
      $exp ='<p style="color:yellow; background-color: red;">Expired</p>';


        if(isset($_POST['submit2'])){

          
        $sql ="SELECT student.username,roll,books.bid,
        name,authors,edition,approved,issue_book.issue,issue_book.return FROM student inner join
        issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE
        issue_book.approved = '$ret' ORDER BY `issue_book`.`return` DESC";
        $res=mysqli_query($db,$sql);

        }else if(isset($_POST['submit3'])){

       
        $sql ="SELECT student.username,roll,books.bid,
        name,authors,edition,approved,issue_book.issue,issue_book.return FROM student inner join
        issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE
        issue_book.approved = '$exp'  ORDER BY `issue_book`.`return` DESC";
        $res=mysqli_query($db,$sql);

        }else{

          $sql ="SELECT student.username,roll,books.bid,
          name,authors,edition,approved,issue_book.issue,issue_book.return FROM student inner join
          issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE
          issue_book.approved != '' and issue_book.approved != 'Yes' ORDER BY `issue_book`.`return` DESC";
          $res=mysqli_query($db,$sql);
  
        }


        echo "<div class='scroll'>";
        echo "<table style='color: white' class='table table-bordered table-hover'>";
        echo "<tr style='background-color:#98c7ce;'>";

            
            echo "<th>";  echo "Student Username";  echo"</th>";
            echo "<th>";  echo "Roll No";  echo"</th>";
            echo "<th>";  echo "BID";  echo"</th>";
            echo "<th>";  echo "Book Name";  echo"</th>";
            echo "<th>";  echo "Author's name";  echo"</th>";
            echo "<th>";  echo "edition";  echo"</th>";
            echo "<th>";  echo "Status";  echo"</th>";
            echo "<th>";  echo "Issue Date";  echo"</th>";
            echo "<th>";  echo "Return Date";  echo"</th>";
            
  
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
            echo "<td>"; echo $row['approved']; echo "</td>";
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