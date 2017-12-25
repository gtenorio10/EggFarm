<?php
// Start the session
session_start();

error_reporting(0);
$error = "";

$servername = 'localhost';
$username = 'Gabriella';
$password = 'IgfFKlNVzrvBg1Q3';
$dbname = 'eggfarm';

// Grab User submitted information
$username_form = $_POST["firstname"];
$password_form = $_POST["password"];
$gold = 2000;
$chick = 0;
$lizard = 0;
$dino = 0;
$deer = 0;

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
// Make sure we connected successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO users (username, password, gold, chick, lizard, dino, deer)
VALUES('$username_form',  '$password_form' ,  '$gold'  , '$chick', '$lizard',  '$dino' , '$deer')";

if (isset($_REQUEST['firstname']) && isset($_REQUEST['password'])) {
    if ($conn->query($sql)=== TRUE){
        echo "New record created Successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <style type="text/css">
        .button
        {
            position: absolute;
            top:165px;
            left: 270px;
        }
        .welcomePosition
        {
            position: absolute;
            top: 20px;
            left: 10px;
            font-size: 30px;
            color:#006400;
            font-family: "Comic Sans MS";
        }
        .messagePosition
        {
            position: absolute;
            top: 50px;
            left: 10px;
            font-size: 20px;
            font-family: "Comic Sans MS";
        }
        .presentmessage
        {
            position: absolute;
            top: 90px;
            left: 10px;
            font-size: 15px;
            font-family: "Comic Sans MS";
        }
        .accountmessage
        {
            position: absolute;
            top: 125px;
            left: 220px;
            font-size: 15px;
            font-family: "Comic Sans MS";
        }
        .form
        {
            position: absolute;
            top: 140px;
            left: 10px;
            font-size: 15px;
            font-family: "Comic Sans MS";
        }

        .barnLocation
        {
            position: absolute;
            top: 300px;
            left: 148px;
        }
        .sunLocation
        {
            position: absolute;
            top: 200px;
            left: 280px;
        }
        .eggLocation
        {
            position: absolute;
            top: 420px;
            left: 290px;
        }
        .panel
        {
            background: #7FFFD4;
            height: 530px;
            width: 400px;
        }
    </style>
    <script>
        function validateForm() {
            var x = document.forms["form"]["firstname"].value;
            var y = document.forms["form"]["password"].value;
            if (x == "") {
                alert("Name must be filled out");
                return false;
            }
            if (y == "") {
                alert("Password must be filled out");
                return false;
            }
        }

        function checkName(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "CheckUserName.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>
<body>



<a href="SQL_Login.php">
    <button class="button">Sign In</button>
</a>

<div class="panel">
    <h1 id="welcome" class="welcomePosition">Welcome to EggFarm!</h1>
    <h4 id="present" class="presentmessage">New Players will recieve 2000 free Gold Coins! </h4>
    <h5 id = "message" class="messagePosition"> We have cute animals and Gold Coins!  </h5>
    <p id= "oldaccount" class="accountmessage"> Have an account already? </p>

    <!--<p id = "user" class="userPosition"> Enter your name: </p>
    <p id = "password" class="passwordPosition"> Enter password: </p> -->
    <div class="form" name="form"  method="post">
        <form name= "form" method="post"onsubmit="return validateForm()" >
            <fieldset>
                <legend>Create New Account</legend>
                Enter Your Name:<br>
                <input type="text" name="firstname" id="firstname" placeholder="Name"><br><br>
                <p id="txtHint" class="msgHint"></p>
                Enter Password:<br>
                <input type="password" name="password" placeholder="Password" required> <br><br>
                <input type="submit" value="Submit" id="Sumbit">
            </fieldset>
        </form>
    </div>




</div>
<img  id = "barn" src="eggPlant2_files\image014.png" class="barnLocation" style="width:240px;height:240px;" />
<img  id = "sun" src="eggPlant2_files\image001.png" class="sunLocation" style="width:100px;height:100px;" />
<img  id = "egg" src="eggPlant2_files\image011.png" class="eggLocation" style="width:70px;height:90px;" />

</div>



</body>
</html>
