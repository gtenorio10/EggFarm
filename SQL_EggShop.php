<?php
session_start();

error_reporting(0);
$error = "";

$username_form = $_SESSION['username'];


$servername = 'localhost';
$username = 'Gabriella';
$password = 'IgfFKlNVzrvBg1Q3';
$dbname = 'eggfarm';


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users 
        WHERE username = '$username_form'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gold = $row['gold'];
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <style type="text/css">

        .panel
        {
            background: khaki;
            height: 520px;
            width: 400px;
        }


        .sign
        {
            position: absolute;
            top: 20px;
            left: 5px;
        }
        h2 {
            position: absolute;
            top: 5px;
            left: 150px;
            font-size: 25px;
            color:snow;
            font-family: "Comic Sans MS";
        }



        .money
        {
            position: absolute;
            top: 70px;
            left: 20px;
        }
        .cashM
        {
            position: absolute;
            top: 30px;
            left: 55px;
            font-size: 20px;
            color:black;
            font-family: "Comic Sans MS";
        }

        .next
        {
            position: absolute;
            top: 420px;
            left: 275px;
        }

        .miniwhitegg
        {
            position: absolute;
            top:20px;
            left: 20px;
        }
        .minigreenegg
        {
            position: absolute;
            top:20px;
            left: 50px;
        }
        .miniredegg
        {
            position: absolute;
            top:20px;
            left: 300px;
        }
        .miniblueegg
        {
            position: absolute;
            top:20px;
            left: 330px;
        }
        .miniwhite
        {
            position: absolute;
            top:400px;
            left:200px;
        }
        .numegg1
        {
            position: absolute;
            top: 400px;
            left: 260px;
            font-size: 20px;
            color:black;
            font-family: "Comic Sans MS";
        }
        .minigreen
        {
            position: absolute;
            top:400px;
            left: 300px;
        }
        .numegg2
        {
            position: absolute;
            top: 400px;
            left: 360px;
            font-size: 20px;
            color:black;
            font-family: "Comic Sans MS";
        }
        .minired
        {
            position: absolute;
            top:450px;
            left: 200px;
        }
        .numegg3
        {
            position: absolute;
            top: 450px;
            left: 260px;
            font-size: 20px;
            color:black;
            font-family: "Comic Sans MS";
        }
        .miniblue
        {
            position: absolute;
            top:450px;
            left: 300px;
        }
        .numegg4
        {
            position: absolute;
            top: 450px;
            left: 360px;
            font-size: 20px;
            color:black;
            font-family: "Comic Sans MS";
        }
        .shopcom
        {
            position: absolute;
            top:110px;
            left: 70px;
        }
        .shopgreen
        {
            position: absolute;
            top:110px;
            left: 230px;
        }
        .shopred
        {
            position: absolute;
            top:250px;
            left: 70px;
        }
        .shopblue
        {
            position: absolute;
            top:250px;
            left: 220px;
        }


        .shelf1
        {
            position: absolute;
            top:210px;
            left: 20px;
        }
        .shelf2
        {
            position: absolute;
            top:350px;
            left: 20px;
        }

        .button1{
            position: absolute;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            top:220px;
            left:80px;
        }
        .button2{
            position: absolute;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            top:220px;
            left:240px;
        }
        .button3{
            position: absolute;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            top:360px;
            left:80px;
        }
        .button4{
            position: absolute;
            color: black;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            top:360px;
            left:240px;
        }
        .farm
        {
            position: absolute;
            top:433px;
            left: 50px;
        }
        .hometext
        {
            position: absolute;
            top:430px;
            left: 60px;
            font-size: 20px;
            color:snow;
            font-family: "Comic Sans MS";
        }

    </style>
    <script>



        var gold= <?php echo $gold?>;
        //var y1= 0;
        //var y2= 0;
        //var y3= 0;
        //var y4= 0;

        function WhiteEggbutton() {
                if(gold>=10) {
                    gold = gold - 10;
                    //y1 = y1 + 1;
                    //document.getElementById("numegg2").innerHTML = y2;
                    alert("You bought a White Egg!");
                    cash.innerHTML = "Gold: " + gold;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + gold, true);
                    xmlhttp.send();
                    window.location.replace("SQL_PHPTapGame.php");
                }
             else if (gold<10){
                    alert("You don't have enough money for this egg")
                }
            }


        function GreenEggbutton() {
                if(gold>=200){
                    gold = gold -200;
                    //y2 = y2 + 1;
                    //document.getElementById("numegg2").innerHTML = y2;
                    alert("You bought a Green Egg!");
                    cash.innerHTML = "Gold: " + gold;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + gold, true);
                    xmlhttp.send();
                    window.location.replace("SQL_PHPTapGameG.php");
                    }
                else if (gold<200){
                    alert("You don't have enough money for this egg");
                }
        }

        function RedEggbutton() {
                if(gold>=300){
                    gold = gold -300;
                    //y3 = y3 + 1;
                    //document.getElementById("numegg3").innerHTML = y3;
                    alert("You bought a Red Egg!");
                    cash.innerHTML = "Gold: " + gold;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + gold, true);
                    xmlhttp.send();
                    window.location.replace("SQL_PHPTapGameR.php");
                }
                else if (gold<300){
                    alert("You don't have enough money for this egg");
                }
        }

        function BlueEggbutton() {
                if(gold>=500){
                    gold = gold -500;
                    //y4 = y4 + 1;
                    //document.getElementById("numegg4").innerHTML = y4;
                    alert("You bought a Blue Egg!");
                    cash.innerHTML = "Gold: " + gold;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + gold, true);
                    xmlhttp.send();
                    window.location.replace("SQL_PHPTapGameB.php");
                }
                else if (gold<500){
                    alert("You don't have enough money for this egg");
                }
            }

    </script>
</head>
<body>

<div class="panel">
</div>

<a href="Homepage.php"><img id="farm" src="eggPlant2_files\sprite25_0.png" class="farm"/></a>
<p id = "hometext" class= "hometext">Home</p>

<div>
    <img id="sign" src="eggPlant2_files\sprite25_0.png" class="sign" style="width:400px;height:50px;/">
    <h2> Egg Shop </h2>
    <h6 id="cash" class="cashM"> Gold: <?php echo $gold?></h6>
    <p id="numegg1" class="numegg1"> 0 </p>
    <p id="numegg2" class="numegg2"> 0 </p>
    <p id="numegg3" class="numegg3"> 0 </p>
    <p id="numegg4" class="numegg4"> 0 </p>
</div>


<img id= "shelf" src="eggPlant2_files\shelf.png" class= "shelf1"/>
<img id= "shelf" src="eggPlant2_files\shelf.png" class= "shelf2"/>


<img id="miniwhiteegg" src="eggPlant2_files\spr_backgroundegg_0.png" class="miniwhitegg"/>
<img id="minigreenegg" src="eggPlant2_files\spr_backgroundrareegg_0.png" class="minigreenegg"/>
<img id="miniredegg" src="eggPlant2_files\spr_backgrounduncommonegg_0.png" class="miniredegg"/>
<img id="miniblueegg" src="eggPlant2_files\spr_backgroundultrarareegg_0.png" class="miniblueegg"/>

<img id="miniwhiteegg" src="eggPlant2_files\spr_backgroundegg_0.png" class="miniwhite"/>
<img id="minigreenegg" src="eggPlant2_files\spr_backgroundrareegg_0.png" class="minigreen"/>
<img id="miniredegg" src="eggPlant2_files\spr_backgrounduncommonegg_0.png" class="minired"/>
<img id="miniblueegg" src="eggPlant2_files\spr_backgroundultrarareegg_0.png" class="miniblue"/>


<img id="shopcom" src="eggPlant2_files\spr_commoneggshop_0.png" class="shopcom"/>
<img id="shopgreen" src="eggPlant2_files\spr_uncommonegg_0.png" class="shopgreen"/>
<img id="shopred" src="eggPlant2_files\spr_rareegg_0.png" class="shopred"/>
<img id="shopblue" src="eggPlant2_files\spr_ultrarareegg_0.png" class="shopblue"/>

<button id= "button1"  class="button1" onclick= "WhiteEggbutton()">$10</button>
<button id= "button2" class="button2" onclick="GreenEggbutton()">$200</button>
<button id= "button3" class="button3" onclick="RedEggbutton()">$300</button>
<button id= "button4" class="button4" onclick="BlueEggbutton()">$500</button>




</body>
</html>
