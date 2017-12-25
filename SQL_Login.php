<?php
session_start();
error_reporting(0);
//Error message
$error = "";

$servername = 'localhost';
$username = 'Gabriella';
$password = 'IgfFKlNVzrvBg1Q3';
$dbname = 'eggfarm';

// Grab User submitted information
$username_form = $_POST["firstname"];
$password_form = $_POST["password"];
$_SESSION["username"]= $_REQUEST['firstname'];
$_SESSION["password"]= $_REQUEST['password'];

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
// Make sure we connected successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (isset($_REQUEST['firstname']) && isset($_REQUEST['password'])) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["username"] == $username_form && $row["password"] == $password_form)
                header('Location: Homepage.php');
            echo "Sorry, your credentials are not valid, Please try again.";
        }
    } else {
        echo "0 results";
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
        .form
        {
            position: absolute;
            top: 120px;
            left: 10px;
            font-size: 15px;
            font-family: "Comic Sans MS";
        }
        .barnLocation
        {
            position: absolute;
            top: 250px;
            left: 90px;
        }
        .sunLocation
        {
            position: absolute;
            top: 140px;
            left: 260px;
        }
        .eggLocation
        {
            position: absolute;
            top: 410px;
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
    </script>

</head>

<body>
<div class="panel">
    <h1 id="welcome" class="welcomePosition">Welcome to EggFarm!</h1>
    <h5 id = "message" class="messagePosition"> Pay 5 Gold Coins to play  </h5>

    <div class="form">
        <form name="form" method="post"onsubmit="return validateForm()">
            Enter Your Name:<br>
            <input type="text" name="firstname" placeholder="Name" id="firstname"><br>
            Enter Password:</br>
            <input type="password" name="password" placeholder="Password" id="password"> <br></br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<img  id = "barn" src="eggPlant2_files\image014.png" class="barnLocation" style="width:304px;height:280px;" />
<img  id = "sun" src="eggPlant2_files\image001.png" class="sunLocation" style="width:100px;height:100px;" />
<img  id = "egg" src="eggPlant2_files\image011.png" class="eggLocation" style="width:70px;height:90px;" />
</div>



</body>
</html>
