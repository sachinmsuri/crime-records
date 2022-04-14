<?php include('menu.php'); ?>
<html>
    <head>  
    <link rel="stylesheet" href="trafficreport.css">
    <script type = "text/javascript" src="error_handling.js"></script>
    </head>
    
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include('config.php');
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql_stat = "SELECT Incident_Report, Incident_Date  FROM Incident WHERE Incident_ID = '".$_GET["ID"]."';";
$result_stat = mysqli_query($conn, $sql_stat);
$row_stat = mysqli_fetch_array($result_stat);

$sql_off = "SELECT Offence_description From Offence WHERE Offence_ID = 
            (SELECT Offence_ID FROM Incident WHERE Incident_ID = '".$_GET["ID"]."');";
$result_off = mysqli_query($conn, $sql_off);
$row_off = mysqli_fetch_array($result_off);

$sql_veh = "SELECT Vehicle_licence, Vehicle_type, Vehicle_Colour FROM Vehicle WHERE Vehicle_ID =
            (SELECT Vehicle_ID FROM Incident WHERE Incident_ID = '".$_GET["ID"]."');";
$result_veh = mysqli_query($conn, $sql_veh);
$row_veh = mysqli_fetch_array($result_veh);

$sql_pers = "SELECT People_licence, People_address, People_name FROM People WHERE People_ID =
            (SELECT People_ID FROM Incident WHERE Incident_ID = '".$_GET["ID"]."');";
$result_pers = mysqli_query($conn, $sql_pers);
$row_pers = mysqli_fetch_array($result_pers);
?>

    <body> 
    <div>
    <b><p>Edit Report<b><p>
    <hr>
    <form method ="POST" name ="form" onchange="return validateForm()" onsubmit="return refreshForm()">
    
    <p class="vertical"><label for="textarea">*Statement:</label><textarea style="height:100px" class="text" rows="2" cols="20" wrap="hard" name="statement" id="statement" maxlength = '500'><?php echo $row_stat[0]; ?></textarea><br/>
   
    <label> Date of Incident*</label>       <input type = "date" name = "date" value = "<?php echo $row_stat[1]; ?>"/><br/>    
   
    <label for="offence">Offence:</label>   <select name="offence" id="offence"><br/>
                                            <option value = "update"></option>
                                            <?php
                                            error_reporting(E_ALL);
                                            ini_set('display_errors',1);
                                            include('config.php');
                                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                                            $sql_list = "SELECT Offence_description FROM Offence;";
                                            $result = mysqli_query($conn, $sql_list);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value = '".$row_off[0]."' selected>".$row_off[0]."</option>";
                                                    echo "<option value ='".$row["Offence_description"]."'>".$row["Offence_description"]."</option>";
                                                    }
                                            }
                                            ?>
                                            </select>
                                            </br>

    <label> Vehicle Number Plate*</label>   <input type = "text" name = "plate" maxlength = '7' value = "<?php echo $row_veh[0]; ?>" /><br/>  
    <label> Vehicle Type</label>            <input type = "text" name = "type" maxlength = '20' value = "<?php echo $row_veh[1]; ?>"/><br/>               
    <label> Vehicle Colour</label>          <input type = "text" name = "colour" maxlength = '20' value = "<?php echo $row_veh[2]; ?>"/><br/>  
    <label> Driving Licence Number*</label> <input type = "text" name = "licence" maxlength = '16' value = "<?php echo $row_pers[0]; ?>" /><br/>   
    <label> Owner Name</label>              <input type = "text" name = "name" maxlength = '50' value = "<?php echo $row_pers[2]; ?>" /><br/>  
    <label> Owner Address</label>           <input type = "text" name = "address" maxlength = '50' value = "<?php echo $row_pers[1]; ?>"/><br/>                 
    <label> </label>                        <input type = "submit" name = "submit" value = "submit">
    <hr>
    </form>

     
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

        if (isset($_POST['plate'], $_POST['date'], $_POST['licence'], $_POST['statement'], $_POST['offence']))
            {
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if(!$conn) {
                    die ("Connection failed");}
        
            if ($_POST['statement'] == "" OR $_POST['date'] == "" OR $_POST['plate'] == "" OR $_POST['licence'] == "" OR $_POST['offence'] == ""){
                echo("<p><p style='color:red'>ERROR - Please fill in Statement, Date, Number Plate, Licence Number & Offence to submit the edited report!<p>");
            }

            if ($_POST['statement'] != "" AND $_POST['date'] != "" AND $_POST['plate'] != "" AND $_POST['licence'] != ""){
                $statement = $_POST['statement'];
                $date = $_POST['date'];
                $plate = $_POST['plate'];
                $licence = $_POST['licence'];
                $offence = $_POST['offence'];
                $type = $_POST['type'];
                $colour = $_POST['colour']; 
                $name = $_POST['name'];
                $address = $_POST['address'];
                
                
                $sql_2 = "UPDATE Incident SET Incident_Report = '".$statement."', Incident_Date = '".$date."', 
                        Offence_ID = (SELECT Offence_ID FROM Offence WHERE Offence_description = '".$offence."')
                        WHERE Incident_ID = '".$_GET["ID"]."';";
                $result_2 = mysqli_query($conn,$sql_2);

                $sql_vehicle = "UPDATE Vehicle SET Vehicle_licence = '".$plate."', Vehicle_type = '".$type."',Vehicle_colour = '".$colour."'
                WHERE Vehicle_ID = (SELECT Vehicle_ID FROM Incident WHERE Incident_ID = '".$_GET["ID"]."');";
                $result_vehicle = mysqli_query($conn,$sql_vehicle);

                $sql_people = "UPDATE People SET People_name = '".$name."', People_address = '".$address."',People_licence = '".$licence."'
                WHERE People_ID = (SELECT People_ID FROM Incident WHERE Incident_ID = '".$_GET["ID"]."');";
                $result_people = mysqli_query($conn,$sql_people);

                
                echo "<meta http-equiv='refresh' content='0'>";

                echo ("<p style='color:green'>Edit Submitted Sucessfully");

        }

    }
        ?>

        </body>
    </html>