<?php include('menu.php'); ?>
<html>

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    </head>

    <body> 
    <div>
    <b><p>Search Vehicles on Database</b><p>
    <hr>
    <form method ="POST" onchange="return validatePlate()" name = "vehicle_lookup">
    Enter Vehicle Plate Number:     <input type = "text" name="plate_number" maxlength = '7'/><br/>
                                    <input type = "submit" value = "Search">

    </form>
    <hr>

    <script type = "text/javascript">
    function validatePlate(){
        var letters = /(^$)|(^[0-9a-zA-Z]+$)/;
            if (document.forms["vehicle_lookup"]["plate_number"].value.match(letters)){
                return true;
                }

            else{
                alert("ERROR - This field only accepts numbers or letters and does not accept spaces)");
                document.forms["vehicle_lookup"]["plate_number"].value = "";
                return false;
            }
    }    
    </script>

    <?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

    if (isset($_POST['plate_number'])){
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(!$conn) {
            die ("Connection failed");
             }

        $plate_number = $_POST["plate_number"];
        if($plate_number == ""){
            echo("<p style='color:red'>Enter a vehicle licence plate number");
        }

        if($plate_number != ""){
            $sql = "SELECT * from Vehicle LEFT OUTER JOIN Ownership on Vehicle.Vehicle_ID = Ownership.Vehicle_ID
                    LEFT OUTER JOIN People on People.People_ID = Ownership.People_ID
                    where Vehicle_licence = '" .$plate_number. "';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
                echo"<table id=list><tr><th>Vehicle Number Plate</th> <th>Vehicle Type</th> <th>Vehicle Colour</th> <th>Owner Name</th> <th>Owner Licence No.</th>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row["Vehicle_licence"]."</td><td>".$row["Vehicle_type"]."</td><td>". $row["Vehicle_colour"]. "</td><td>". $row["People_name"]. "</td><td>" .$row["People_licence"]. "</td></tr>";
                }
                echo"</table>";
            }
            else{
                echo("<p style='color:red'>No Results Found");
            }

        }
        }
    ?> 
    </body>
</html>   