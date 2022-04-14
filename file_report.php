<?php include('menu.php'); ?>
<html>

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    <script type = "text/javascript" src="error_handling.js"></script>
    </head>
     
    <body> 
    <div>
    <b><p>File Report</b><p>
    <hr>
    <form method ="POST" name = "form" id="new_report" onchange = "return validateForm()">
    <p class="vertical"><label for="textarea">*Statement:</label><textarea style="height:100px" class="text" rows="2" cols="20" wrap="hard" name="statement" id="statement" maxlength = "500"></textarea><br/>
    <label>*Date of Incident:</label>      <input type = "date" name = "date"/><br/>    
    <label for="offence">*Offence:</label>   <select name="offence" id="offence"><br/>
                                            <?php
                                            error_reporting(E_ALL);
                                            ini_set('display_errors',1);
                                            include('config.php');
                                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                                            $sql_list = "SELECT Offence_description FROM Offence;";
                                            $result = mysqli_query($conn, $sql_list);
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value ='".$row["Offence_description"]."'>".$row["Offence_description"]."</option>";
                                                    }
                                            }
                                            ?>
                                            </select>
                                            </br>
    <label>*Vehicle Number Plate:</label>   <input type = "text" name = "plate" maxlength = '7'/><br/>  
    <label>*Vehicle Type:</label>            <input type = "text" name = "type" maxlength = '20'/><br/>               
    <label>*Vehicle Colour:</label>          <input type = "text" name = "colour" maxlength = '20'/><br/>  
    <label>*Driving Licence Number:</label> <input type = "text" name = "licence" maxlength = '16'/><br/>   
    <label>*Owner Name:</label>              <input type = "text" name = "name" maxlength = '50'/><br/>  
    <label>Owner Address:</label>           <input type = "text" name = "address" maxlength = '50'/><br/>                 
    <label> </label>                        <input type = "submit" name = "submit" value = "submit"><br/>
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
                echo("<p><p style='color:red'>ERROR - Please fill in Statement, Date, Number Plate, Licence Number, Offence, Vehicle Type, Vehicle Colour & Owner Name to submit a report!<p>");
            }

            if ($_POST['statement'] != "" AND $_POST['plate'] != "" AND $_POST['licence'] != "" AND $_POST['date'] != ""){
                $statement = $_POST['statement'];
                $date = $_POST['date'];
                $plate = $_POST['plate'];
                $licence = $_POST['licence'];
                $offence = $_POST['offence'];
                
                
                $sql = "INSERT INTO Incident (Officer_username, Incident_Date, Incident_Report, Offence_ID)
                        VALUES ('".$_SESSION['username']."','".$date."','".$statement."',(SELECT Offence_ID FROM Offence WHERE Offence_description ='".$offence."'))";
                $result = mysqli_query($conn,$sql);

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
                
                $sql_7 = "UPDATE Incident SET Vehicle_ID = (SELECT Vehicle_ID FROM Vehicle WHERE Vehicle_licence = '".$_POST['plate']."') 
                        WHERE Incident_Report = '".$_POST['statement']."' and Incident_Date = '".$_POST['date']."';";

                $sql_8 = "UPDATE Incident SET People_ID = (SELECT People_ID FROM People WHERE People_licence = '".$_POST['licence']."') 
                        WHERE Incident_Report = '".$_POST['statement']."' and Incident_Date = '".$_POST['date']."';";



                if (mysqli_num_rows($result_2)==0 and mysqli_num_rows($result_3)==0) {
                        $result_4 = mysqli_query($conn,$sql_4);
                
                        $result_5 = mysqli_query($conn,$sql_5);

                        $result_6 = mysqli_query($conn,$sql_6);

                        $result_7 = mysqli_query($conn,$sql_7); 

                        $result_8 = mysqli_query($conn,$sql_8); 

    
                        echo("<p><p style='color:green'>Report Submitted Sucessfully<p>");
                }


                if (mysqli_num_rows($result_2)>0 and mysqli_num_rows($result_3)==0) {
                        $result_5 = mysqli_query($conn,$sql_5);

                        $result_6 = mysqli_query($conn,$sql_6);

                        $result_7 = mysqli_query($conn,$sql_7); 

                        $result_8 = mysqli_query($conn,$sql_8); 

                        echo("<p><p style='color:green'>Report Submitted Sucessfully<p>");
                    
                }

                if (mysqli_num_rows($result_2)==0 and mysqli_num_rows($result_3)>0) {
                    $result_4 = mysqli_query($conn,$sql_4);

                    $result_6 = mysqli_query($conn,$sql_6);

                    $result_7 = mysqli_query($conn,$sql_7); 

                    $result_8 = mysqli_query($conn,$sql_8); 

                    echo("<p><p style='color:green'>Report Submitted Sucessfully<p>");

                    }

            
                if (mysqli_num_rows($result_2)>0 and mysqli_num_rows($result_3)>0){
                    $result_7 = mysqli_query($conn,$sql_7); 

                    $result_8 = mysqli_query($conn,$sql_8); 

                    echo("<p><p style='color:green'>Report Submitted Sucessfully<p>");
                }

                

            }

        }

        ?>




        </body>
    </html>