<html>
   
    <style>        
        body {
            font-family: sans-serif;
            background-color: lightskyblue;
            }
        header{
            text-align: center;
            font-family: sans-serif;
            color: dimgrey;
        }

        div {
            margin:auto;
            border-radius:25px;
            background-color: white;
            padding: 20px;
            width: 30%;
            border-style: groove;    
        }
        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px 20px;
            margin: 8px 0;
            display: inline-block;
        }

        input[type=submit]{
            background-color: lightgrey;
            margin: 8px 0;
            padding: 8px 20px;
            width: 100%;
        }

    </style>
        <header>
        <h1><b> TRAFFIC REPORTING</b></h1>
        </header>

        <body> 
        <div>
        <form method ="POST">
                <b><label for="usname"> Username: </label>
                    <input type = "text" id = "usname" name="username"/>

                <b><label for="pswd"> Password: </label>
                    <input type = "password" id = "pswd" name="password"/>
                <hr>
                    <input type = "submit" value = "Login">
        </form>
    
  
    <?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    include('config.php');

    if (isset($_POST['username'], $_POST['password']))
    {
     $conn = mysqli_connect($servername, $username, $password, $dbname);
     if(!$conn) {
         die ("Connection failed");
      }
      
        $_SESSION['username'] = $_POST['username'];
        $password = $_POST['password'];

        if ($username != "" && $password != ""){
            $sql = "SELECT * FROM Users WHERE Username = '".$_SESSION['username']."' and User_Password = '".$password."';";

            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) > 0) {
                header("Location:change_password.php");}

            else {echo("<p style='color:red'><i>LOGIN FAILED - incorrect username or password (password is case sensitive)</i>");}
            mysqli_close($conn);
            }

            else{
            echo("<p style='color:red'><i>Login Failed - Please Enter Both Username & Password</i>");
            }
    }
    ?>
    </div>  
    <header>
    <h5><i>*contact the system administrator if you do not have an account or have forgotten your account details</i><h5>
    <header>

    </body>
 </html>


