<?php include('menu.php'); ?>


<html> 

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    <script type = "text/javascript" src="error_handling.js"></script> 
    </head>
    
    <body> 
    <div>
    <b><p> Add New Police Officer</p></b>
    <form method ="POST" name = "new_officer" onchange = "return validateOfficer()">
    <hr>
       <label>*Officer Name:</label>         <input type = "text" name = "name"/><br/>
       <label>*Officer Username:</label>     <input type = "text" name = "username"/><br/>               
       <label>*Officer Password:</label>     <input type = "text" name = "password"/><br/>          
       <label></label>                      <input type = "submit" name = "submit" value = "submit">
    </form>
    <hr>

    <script type = "text/javascript">
    function validateForm(){
        var letters = /(^$)|(^[a-zA-Z\s]+$)/;

        if (document.forms["new_officer"]["name"].value.match(letters)){
            return true;
            }

        else{
            alert("ERROR - This field only accepts letters and spaces");
            document.forms["new_officer"]["name"].value = "";
            return false;
            }
        }   
    </script>

    <?php
    function addOfficer(){
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        include('config.php');

        if (isset($_POST['name'], $_POST['username'], $_POST['password']))
        {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn) {
                die ("Connection failed");}

            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];


        $sql_username = "SELECT Username FROM Users WHERE Username = '".$username."';";
        $result_username = mysqli_query($conn,$sql_username);
        
        if(mysqli_num_rows($result_username)>0){
            echo("<p style='color:red'><i>ERROR - Username already exists, please choose another username</i>");
            return false;
        }

            if($name != "" and $username != "" and $password != ""){
                $sql = "INSERT INTO Users (Username, User_Password, Name, User_type)
                    VALUES ('".$username."','".$password."','".$name."','Officer');";
                    $result = mysqli_query($conn,$sql);

                    echo("<p style='color:green'><i>Officer Account Created Successfully<i>");
                }

                else{
                    echo("<p style='color:red'><i>Error: All fields must be entered to create a new officer in the database<i>");
                }

            }
    }
    addOfficer();

    ?>
    </body>
    </html>
