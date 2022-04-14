<?php include('menu.php'); ?>

<html> 

    <head>
    <link rel="stylesheet" href="trafficreport.css"/> 
    <script type = "text/javascript" src="error_handling.js"></script> 
    </head>

    <body> 
    <div>
    <b><p>Enter New Vehicle</b><br>
    <i>(* is a required field)</i></p>
    <form method ="POST" name = "form" onchange = "return validateForm()">
    <hr>
       <label>*Licence Plate Number:</label>   <input type = "text" name = "plate" maxlength = '7'/><br/>
       <label>*Vehicle Type:</label>           <input type = "text" name = "type" maxlength = '20' /><br/>               
       <label>*Vehicle Colour:</label>         <input type = "text" name = "colour" maxlength = '20'/><br/>  
       <label>*Owner Name:</label>             <input type = "text" name = "name" maxlength = '50'/><br/>  
       <label>*Owner Licence Number:</label>   <input type = "text" name = "licence" maxlength = '16'/><br/>
       <label>Owner Address:</label>           <input type = "text" name = "address" maxlength = '50'/><br/>               
       <label></label>                         <input type = "submit" name = "submit" value = "submit">
    </form>
    <hr>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

    if (isset($_POST['plate'], $_POST['name'], $_POST['licence'], $_POST['type'], $_POST['colour']))
    {
        $conn = mysqli_connect($servername, $username, $password, $dbname);
         if(!$conn) {
            die ("Connection failed");}
        
        if ($_POST['plate'] == "" OR $_POST['name'] == "" OR $_POST['licence'] == "" OR $_POST['type'] == "" OR $_POST['colour'] == "" ){
            echo("<p style='color:red'><i>ERROR - you cannot leave 'license plate number', 'owner name', 'owner driving licence number', 'vehicle colour' and 'vehicle type' blank</i>");
        }

        if ($_POST['plate'] != "" AND $_POST['name'] != "" AND $_POST['licence'] != "" AND $_POST['type'] != "" AND $_POST['colour'] != ""){
                $plate = $_POST['plate'];
                $licence = $_POST['licence'];

                $sql_2 = "SELECT * from Vehicle WHERE Vehicle_licence = '".$plate."';";
                $result_2 = mysqli_query($conn,$sql_2);

                $sql_3 = "SELECT * from People WHERE People_licence = '".$licence."';";
                $result_3 = mysqli_query($conn,$sql_3);

                $sql_4 = "INSERT INTO Vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence)
                        VALUES ('".$_POST['type']."','".$_POST['colour']."','".$_POST['plate']."');";

                $sql_5 = "INSERT INTO People (People_name, People_licence, People_address)
                        VALUES ('".$_POST['name']."','".$_POST['licence']."','".$_POST['address']."');";
                
                $sql_6 = "INSERT INTO Ownership (People_ID, Vehicle_ID)
                        SELECT People_ID, Vehicle_ID FROM People, Vehicle
                        WHERE People_licence = '".$_POST['licence']."' and Vehicle_licence = '".$_POST['plate']."';";

                if (mysqli_num_rows($result_2)==0 and mysqli_num_rows($result_3)==0) {
                $result_4 = mysqli_query($conn,$sql_4);

                $result_5 = mysqli_query($conn,$sql_5);

                $result_6 = mysqli_query($conn,$sql_6);

                echo("<p><p style='color:green'><i>Vehicle & Owner Submitted Sucessfully</i><p>");
                }


                if (mysqli_num_rows($result_2)>0 and mysqli_num_rows($result_3)==0) {
                $result_5 = mysqli_query($conn,$sql_5);

                $result_6 = mysqli_query($conn,$sql_6);

                echo("<p><p style='color:green'><i>SUCCESS - Vehicle already listed on database, New person has now been assigned ownership of vehicle</i><p>");

                }

                if (mysqli_num_rows($result_2)==0 and mysqli_num_rows($result_3)>0) {
                $result_4 = mysqli_query($conn,$sql_4);

                $result_6 = mysqli_query($conn,$sql_6);

                echo("<p><p style='color:green'><i>SUCCESS - Owner already listed on database, New vehicle has been assigned to the owner</i><p>");

                }


                if (mysqli_num_rows($result_2)>0 and mysqli_num_rows($result_3)>0){
                echo("<p><p style='color:green'><i>SUCCESS - Vehicle & Owner Already Listed In Database</i><p>");
                }

            }

        }

        ?>




</body>
</html>