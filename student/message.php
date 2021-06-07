<?php
include "connection.php";
include "navbar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=style, initial-scale=1.0">
    <title>Document</title>
</head>
<style type="text/css">
.wrapper{
    height: 600px;
    width: 500px;
    background-color: black;
    opacity: 0.9;
    color: white;
    margin: -20px auto;
    padding: 10px;

}
.form-control{
    height: 47px;
    width: 77%;

}
.msg{
    height: 450px;
    /* background-color: red; */
    overflow-y: scroll;
}
.btn-info{
    background-color: #02c5b6;

}
.chat{
    display: flex;
    flex-flow: row wrap;
}
.user .chatbox{
    height: 50px;
    width: 400px;
    padding: 13px;
    background-color: green;
    border-radius: 10px; 
    order: -1;
    color: white;
}

.admin .chatbox{
    height: 50px;
    width: 400px;
    padding: 13px;
    background-color: red;
    border-radius: 10px; 
    color: white;
    
  
}
    
    

    </style>
<body>

<?php

if(isset($_POST['submit']))
{
    mysqli_query($db,"INSERT into `library`.`message` VALUES ('','$_SESSION[login_user]','$_POST[message]','no',
    'student'
   );");
   $res = mysqli_query($db,"SELECT * from message where username='$_SESSION[login_user]';");
}else{

    $res = mysqli_query($db,"SELECT * from message where username='$_SESSION[login_user]';");

}
    
mysqli_query($db,"UPDATE message set status='yes' where sender ='admin' and username = '$_SESSION[login_user]'; ");

    

?>


<div class="wrapper">
    <div class="wrapper">
        <div style="height: 70px; width: 100%; background-color: #2eac8b; text-align: center;">
            <h3 style="margin-top: -5px; padding-top: 10px;">Admin</h3>

        </div>

        <div class="msg">
            <br>            
            <?php
                while($row=mysqli_fetch_assoc($res))
               
                {
                    
                   
                    if($row['sender'] == 'student')
                        {


                


            ?>
            <!-- student -->
            <br>

            <div class="chat user">
                <div style="float : left; padding-top: 5px;">
                &nbsp 
                <?php
                 echo "<img class='img-circle profile_img' style ='background-color: white; width: 40; height: 40;'  src='images/".$_SESSION['pic']."' >";
                
                ?>&nbsp


                </div>
                <div style="float: left;" class="chatbox">
                <?php
                    echo $row['message'];
                    

                ?>

                  
                </div>


            </div>
            <br>
            <?php

                }
                else
                {

                
                
            ?>
            
<!-- Admin    -->
            <div class="chat admin">
                <div style="float : left; padding-top: 5px;">
                &nbsp
                <?php
                 echo "<img class='img-circle profile_img'
                  style ='background-color: white; width: 40; height: 40;'  src='images/username-icon.png' >";
                
                ?>&nbsp
                


                </div>
                <div style="float: left;" class="chatbox">
                <?php
                    echo $row['message'];
                    

                ?>

                </div>


            </div>
            <br>
            <?php
                }
            }
            
            
            ?>
    
          
            </div>


       

        <div style="height: 50px; padding-top: 10px;">
            <form action="" method="post">
                <input type="text" name="message" class="form-control" required="" placeholder="Write Message......" style="float: left;"> &nbsp
                <button class="btn btn-info btn-lg" type="submit" name="submit"><span class="glyphicon glyphicon-send"></span>Send</button>
            </form>

        </div>
    </div>
    </div>



</body>
</html>