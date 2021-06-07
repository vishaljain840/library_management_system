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
    <title>Feedback</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">
body{
    background-image: url("images/feedback.png")
}
.wrapper{
    width: 900px;
    height: 600px;
    background-color: black;
    opacity: 0.8;
    color: white;
    padding: 10px;
    margin: -20px auto;
}
.form-control{
    height: 70px;
    width: 60%;
}
.scroll{
    width: 100%;
    height: 350px;
    overflow: auto;
}
</style>
</head>
<body>
<div class="wrapper">
<h4>If you have any suggestions or questions please comment below <h4>

<form  style="" action="" method="post">
<input class="form-control" type="text" name="comment" placeholder="Write something....."><br><br>
<input class="btn btn-default" type="submit" name="submit" value="Comment" style="width: 100px; height: 40px;">
</form>
<br><br>
<div class="scroll">
<?php

if(isset($_POST['submit']))
{
    $sql="INSERT into `comments` values('','Admin','$_POST[comment]');";
    if(mysqli_query($db,$sql))
    {
        $q="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
        $res=mysqli_query($db,$q);
        echo "<table class='table table-bordered'>";
        while ($row=mysqli_fetch_assoc($res))
        {
            echo "<tr>";
            echo "<td>"; echo $row['username']; echo "</td>";
            echo "<td>"; echo $row['comment']; echo "</td>";
            echo "</tr>";
        }
    }


}
else{

    $q="SELECT * FROM `comments`";
    $res=mysqli_query($db,$q);
    echo "<table class='table table-bordered'>";
    while ($row=mysqli_fetch_assoc($res))
    {
        echo "<tr>";
        echo "<td>"; echo $row['username']; echo "</td>";
        echo "<td>"; echo $row['comment']; echo "</td>";
        echo "</tr>";
    }

}


?>
</div>
</div>
    
</body>
</html>