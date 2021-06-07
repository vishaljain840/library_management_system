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
    <title>Profile</title>
    <style>
    .wrapper{
        width: 500px;
        margin: 0 auto;
        color: white;
        
    }
    body{
        color: black;
        text-align: center;
    }
    </style>
</head>
<body style="background-color: #274a27;">
<div class="container">
<form action="" method="post">
<button class="btn btn-default" style="float: right; width:70px;" name="submit1" type="submit">EDIT</button>
</form>
<div class="wrapper" style="color: white;" >
<?php

if(isset($_POST['submit1']))
{
    ?>
    <script type="text/javascript">
        window.location="edit.php";
    </script>


    <?php
}

$q = mysqli_query($db,"SELECT * FROM admin where username='$_SESSION[login_user]' ;");


?>
<h2 style="text-align: center;">My Profile</h2>

<?php
$row=mysqli_fetch_assoc($q);

echo "<div style='text-align: center'><img class='img-circle' height=110 width=120 src='images/".$_SESSION['pic']."'></div>";

?>
<div  style="text-align: center"><b>Welcome</b></div>
<h4 >
<?php echo $_SESSION['login_user']; ?>
</h4>
<div class="table" style="color:white;">
<?php

echo "<table class='table table-border'>";

echo "<tr>";
echo "<td>";
echo "<b>First Name: </b>";
echo "</td>";

echo "<td>";
echo $row['first'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<b>Last Name: </b>";
echo "</td>";

echo "<td>";
echo $row['last'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<b>User Name: </b>";
echo "</td>";

echo "<td>";
echo $row['username'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<b>Pssword: </b>";
echo "</td>";

echo "<td>";
echo $row['password'];
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td>";
echo "<b>email: </b>";
echo "</td>";

echo "<td>";
echo $row['email'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<b>Contact: </b>";
echo "</td>";

echo "<td>";
echo $row['contact'];
echo "</td>";
echo "</tr>";


echo "</table>";



?>
</div>
</div>



</div>
    
</body>
</html>
