<?php

$db=mysqli_connect("localhost","root","","library");/* server name, username, password, database  */

if(!$db)
{
    die("Connnection failed: " . mysqli_connect_error());
}

echo "Connected successfully.";

?>

