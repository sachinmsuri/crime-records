<?php include('menu.php'); ?>

<html> 

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    </head>
    
    <body> 
    <div>
    <b><p> Change Password </p></b>
    <hr>
    <form method ="POST" name = "change_password">
        <label>New Password:</label>           <input type = "password" name="new_password" maxlength = '25'/><br/>
        <label>Retype New Password:</label>    <input type = "password" name="new_password_2" maxlength = '25'/><br/>
        <label></label>                        <input type = "submit" value = "Save Changes">
    </form>
    <hr>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');



    if(isset($_POST['new_password'], $_POST['new_password_2']))
    {
        $conn = $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(!$conn){
            die ("Connection failed");
        }

        $new_password = $_POST['new_password'];
        $new_password_2 = $_POST['new_password_2'];


        if ($new_password == $new_password_2 AND $new_password != "" ){
            $sql = "UPDATE Users SET User_Password = '" .$new_password. "' WHERE Username = '".$_SESSION['username']. "';";
            $result = mysqli_query($conn,$sql);

            echo("<p style='color:green'>Password Successfully Changed");}
        else{echo "<p style='color:red'> ERROR - Passwords do not match or form has been left blank";}
    
    }
    ?>
    </body>
</html>