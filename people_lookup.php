<?php include('menu.php'); ?>

<html>

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    </head>

    <body> 
    <div>
    <b><p>Search People on Database</p></b>
    <hr>
    <form method ="POST">
       <label>Name or Driving Licence Number:</label>   <input type = "text" name="name_number"/><br/>
                                                        <input type = "submit" value = "Search">
    </form>
    <hr>

    <?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

    if (isset($_POST['name_number'])){
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(!$conn) {
            die ("Connection failed");
             }
        
        $name_number = $_POST['name_number'];

        if($name_number == ""){
            echo("<p style='color:red'><i>Please enter a name or drivers licence number</i>");
        }

        if($name_number != ""){
            $sql = "SELECT * FROM People WHERE People_name  LIKE '%". $name_number . "%' OR People_licence = '" .$name_number. "';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
                echo"<table id=list><tr><th>ID</th> <th>Name</th> <th>Address</th> <th>Licence Number</th>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>".$row["People_ID"]."</td><td>".$row["People_name"]."</td><td>". $row["People_address"]. "</td><td>". $row["People_licence"]. "</td></tr>";
                }
                echo "</table>";
            }
            else{
                echo("<p style='color:red'><i>No Results Found</i>");
            }
        }
    }
     
    ?>

    </body>
</html>