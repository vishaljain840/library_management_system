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
    <title>Messages</title>
</head>
<style type="text/css">
.left_box{
    height: 600px;
    width: 500px;
    float: left;
    background-color:#8ecdd2;
    margin-top: -20px;
}
.right_box{
    height: 600px;
    width: 970px;
    background-color: #8ecdd2;
    margin-left: 350px;
    margin-top: -20px;
    padding: 10px;
}
.left_box2{
    height: 600px;
    width: 300px;
    background-color: #537890;
    border-radius: 20px;
    float: right;
    margin-right: 30px; 
}
.list{
    height: 500px;
    width: 300px;
    background-color: #537890;
    float: right;
    color: white;
    padding: 10px;
    overflow-y: scroll;
    overflow-x: hidden; 

}
.right_box2{
    height: 660px;
    width: 600px;
    margin-top: -20px;
    padding: 20px;
    border-radius: 20px;
    background-color: #537890;
    float: left;
    color: white;
}
tr:hover{
    background-color: #1e3f54;
    cursor: pointer;
    color: white;

}
.left_box input{
    width: 150px;
    height: 50px;
    background-color: #537890;
    padding: 10px;
    margin: 10px;

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
    width: 450px;
    padding: 13px;
    background-color: green;
    border-radius: 10px; 
 
    color: white;
}

.admin .chatbox{
    height: 50px;
    width: 450px;
    padding: 13px;
    background-color: red;
    border-radius: 10px; 
    order: -1;  
    color: white;
  
}





</style>
<body style="width: 1350px; height: 595px; ;">
<?php
    $sql1=mysqli_query($db,"SELECT student.pic,message.username FROM student
     INNER JOIN message ON student.username=message.username group by username
     ORDER BY status;");

?>
<!-- Left Box -->
<div class="left_box">
    <div class="left_box2">
    <div>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="username" id="uname">
        <button type="submit" name="submit" class="btn btn-default">SHOW</button>
    </form>
    </div>
        <div class="list">
        <?php
            echo "<table id='table' class='table' >";
                while($res1=mysqli_fetch_assoc($sql1))
                {

                
                echo "<tr>";
                    echo "<td idth=65>"; echo "<img class='img-circle profile_img' height=60
                    width=60 src='images/username-icon.png'> ";echo "</td>";

                    echo "<td style='padding-top:30px; color='white''>"; echo $res1['username']; echo "</td>";



                
            echo "</tr>";
                }

            echo "</table>";
        ?>
        </div>

    </div>
</div>
<!-- Right Box -->   
<div class="right_box">
    <div class="right_box2">
    <br>
    <!-- if submit is pressed----------------------- -->
    <?php
    if(isset($_POST['submit']))
    {
        $res = mysqli_query($db, " SELECT * from message where username='$_POST[username]' ;");
        if($_POST['username'] != ''){$_SESSION['username'] = $_POST['username'];

        }
        ?>

        <div style="height: 70px; width: 100%; text-align: center; color: white;">
        <h3 style="margin-top: -5px; padding-top: 10px;"> <?php echo $_SESSION['username']  ?></h3>

        </div>
        <!-- show message -->

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
       

        <div style="height: 100px; padding-top: 10px;">
            <form action="" method="post">
                <input type="text" name="message" class="form-control" required="" placeholder="Write Message......" style="float: left;"> &nbsp
                <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>Send</button>
            </form>

        </div>
    </div>



        <?php
    }
    /*-- if submit is not pressed----------------------- --*/
    else{

        // if($_SESSION['username']=='')
        // {
            ?>
            <img style="margin: 100px 80px;" src="https://media.giphy.com/media/ZGU890vUpxuOKjKcpZ/giphy.gif" alt="animated">
            
            <?php
        // }

    }




?>
    </div>

</div>
                <script>
                   var table = document.getElementById('table'),eIndex;
                   for(var i = 0; i< table.rows.length; i++)
                   {
                       table.rows[i].onclick = function()
                       {
                           rIndex = this.rowIndex;
                           document.getElementById("uname").value = this.cells[1].innerHTML;
                       }
                   }
                </script>
</body>
</html>