<?php include('menu.php'); ?>


<html> 

    <head>
    <link rel="stylesheet" href="trafficreport.css">
    <script type = "text/javascript" src="error_handling.js"></script>
    </head>

    <body> 
    <div>
    <b><p> Add Fine</p></b>
    <form method ="POST" name = "add_fine" onchange = "return validateFine()" >
    <hr>
       <label>*Incident ID:</label>          <input type = "text" name = "id"/><br/>
       <label>*Fine - Charge (£):</label>    <input type = "text" name = "charge"/><br/>               
       <label>*Fine - No. Points</label>     <input type = "text" name = "points"/><br/>          
       <label></label>                       <input type = "submit" name = "submit" value = "submit">
    </form>
    <hr>


    <?php
  
    function addFine(){
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        include('config.php');

        if (isset($_POST['id'], $_POST['charge'], $_POST['points']))
        {
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn) {
                die ("Connection failed");}

            $id = $_POST['id'];
            $charge = $_POST['charge'];
            $points = $_POST['points'];

            $sql_exist = "SELECT * FROM Fines WHERE Incident_ID = '".$_POST['id']."';";
            $result_exist = mysqli_query($conn,$sql_exist);
                if (mysqli_num_rows($result_exist)>0){
                    echo("<p style='color:red'><i>ERROR - This incident already has a fine, you cannot override a fine <br/> please contact the system administrator</i>");
                    return false;
                }

            $sql_id = "SELECT * FROM Incident WHERE Incident_ID = '".$_POST['id']."';";
            $result_id = mysqli_query($conn,$sql_id);
            if (mysqli_num_rows($result_id) == 0){
                echo("<p style='color:red'><i>ERROR - No incident has this ID, please use a valid Incident ID</i>");
                return false;
                }

           
            $sql_maxfine = "SELECT Offence_maxFine FROM Offence WHERE Offence_ID = (SELECT Offence_ID FROM Incident WHERE Incident_ID = '".$id."');";
            $result_maxfine = mysqli_fetch_array(mysqli_query($conn, $sql_maxfine));

            $sql_maxpoints = "SELECT Offence_maxPoints FROM Offence WHERE Offence_ID = (SELECT Offence_ID FROM Incident WHERE Incident_ID = '".$id."');";
            $result_maxpoints = mysqli_fetch_array(mysqli_query($conn, $sql_maxpoints));

            if ($charge > $result_maxfine[0]){
                echo("<p style='color:red'><i>ERROR - Max fine(GBP) for this offence is"." ".$result_maxfine[0]."</i>");
                return false;
            }

            if ($points > $result_maxpoints[0]){
                echo("<p style='color:red'><i>ERROR - Max points for this offence is"." ".$result_maxpoints[0]."</i>");
                return false;
            }


            if(mysqli_num_rows($result_id)>0 and $id != "" and $charge != "" and $points != ""){
                $sql = "INSERT INTO Fines (Fine_Amount, Fine_Points, Incident_ID)
                    VALUES ('".$charge."','".$points."','".$id."');";
                    $result = mysqli_query($conn,$sql);

                    echo("<p style='color:Green'><i>Fine Added Successfully</i>");
                }

                else{
                    echo("<p style='color:red'><i>ERROR: All fields must be entered to add fine to the database</i>");
                }

            }

    }
    addFine();

    ?>
    </body>
    </html>