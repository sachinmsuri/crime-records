<?php include('menu.php'); ?>

<html>

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    </head>

<div>
<b><p>Reports Filed</p><b>
<hr>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if(!$conn) {
            die ("Connection failed");
             }

    $sql = ("SELECT * FROM Incident 
            left join Offence on Incident.Offence_ID = Offence.Offence_ID
            left join People on People.People_ID = Incident.People_ID
            left join Vehicle on Vehicle.Vehicle_ID = Incident.Vehicle_ID 
            WHERE Officer_username = '".$_SESSION['username']."';");

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0){
        echo"<table id=list><tr><th>Report ID</th> <th>Date</th> <th>Statement</th> <th>Offence Description</th> <th>Name</th> <th>Licence Number</th> <th>Number Plate</th> <th></th>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row["Incident_ID"]."</td><td>".$row["Incident_Date"]."</td><td>". $row["Incident_Report"]. "</td><td>". $row["Offence_description"]. "</td><td>" .$row["People_name"]. "</td><td>" .$row["People_licence"]."</td><td>".$row["Vehicle_licence"]."</td><td> <a href='edit_report.php?ID=$row[Incident_ID]'>edit</a></td></tr>";
        }
        echo "</table>";
    }
    else{
        echo("No Report Files");
    }
?>
</div>
</html>