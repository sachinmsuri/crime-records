<html>
    <head>
        <style>
            body {
                font-family: sans-serif;
                }

                ul {
                list-style-type: none;
                margin: -8px;
                padding: 0px;
                overflow: hidden;
                background-color: lightskyblue;   
                }

                li {
                float: left;
                border-right:1.5px solid;
                color: white;
                }

                li:last-child {
                float: right;
                border-right: none;
                }

                li a {
                display: block;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                }

        </style>
        
        <header>        
        <ul>
        <b> <li><a href="change_password.php">Account / Change Password</a></li>
            <li><a href="people_lookup.php">People Lookup</a></li>
            <li><a href="vehicle_lookup.php">Vehicle Lookup</a></li>
            <li><a href="add_vehicle2.php">Add Vehicle</a></li>
            <li><a href="file_report.php">File Report</a></li>
            <li><a href="list_reports.php">Edit Report</a></li>
            
            <?php
            session_start();
            error_reporting(E_ALL);
            ini_set('display_errors',1);
            include('config.php');
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn) {
            die ("Connection failed");}
            $sql = "SELECT * FROM Users WHERE Username = '".$_SESSION['username']."' AND User_type = 'Admin';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            echo ("<li><a href=add_fine.php>Add Fine</a></li>");
            echo ("<li><a href=add_officer.php>Add Officer</a></li>");
            }
            ?>

            <li><a href="login.php">Logout</a></li></b>


        </header>
 
</html>   