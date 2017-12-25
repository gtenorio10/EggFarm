<?php
session_start();

error_reporting(0);
$error = "";

//$filename= $_SESSION["filename"];
$username_form = $_SESSION['username'];


$servername = 'localhost';
$username = 'Gabriella';
$password = 'IgfFKlNVzrvBg1Q3';
$dbname = 'eggfarm';


$conn = new mysqli($servername, $username, $password, $dbname);
// Make sure we connected successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the user data's row
$sql = "SELECT * FROM users 
        WHERE username = '$username_form'";

$sql_chick = "SELECT * FROM animal 
        WHERE animal = 'chick'";

$sql_lizard = "SELECT * FROM animal 
        WHERE animal = 'lizard'";

$sql_dino = "SELECT * FROM animal 
        WHERE animal = 'dino'";

$sql_deer = "SELECT * FROM animal 
        WHERE animal = 'deer'";


$result = $conn->query($sql);

//chick
$result_c = $conn->query($sql_chick);
//lizard
$result_l = $conn->query($sql_lizard);
//dino
$result_di = $conn->query($sql_dino);
//deer
$result_de = $conn->query($sql_deer);



if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $gold = $row['gold'];
}
// chick gold
if ($result_c->num_rows > 0) {
    $row = $result_c->fetch_assoc();
    $gold_c = $row['gold_factor'];
}
// lizard gold
if ($result_l->num_rows > 0) {
    $row = $result_l->fetch_assoc();
    $gold_l = $row['gold_factor'];
}
//dino gold
if ($result_di->num_rows > 0) {
    $row = $result_di->fetch_assoc();
    $gold_di = $row['gold_factor'];
}

//deer gold
if ($result_de->num_rows > 0) {
    $row = $result_de->fetch_assoc();
    $gold_de = $row['gold_factor'];
}
$conn->close();

$myfile = fopen("config.txt", "r") or die("Unable to open file");
$data = array();
$temp = array();
while(!feof($myfile)){
    $line = fgets($myfile);
    $temp = explode(":",$line);
    $data[$temp[0]] = $temp[1];
}
fclose($myfile);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <style type="text/css">
        .nest
        {
            position: relative;
            top:  100px;
            left: 0px;
        }
        .eggLocation
        {
            position: absolute;
            top: 70px;
            left: 100px;
        }
        .animalLocation
        {
            position: absolute;
            top: 50px;
            left: 100px;
        }
        .textM
        {
            position: absolute;
            top: 320px;
            left: 50px;
            font-size: 20px;
            color:Black;
            font-family: "Comic Sans MS";

        }
        .goldMPosition
        {
            position: absolute;
            top: 10px;
            left: 30px;
            font-size: 20px;
            color:Black;
            font-family: "Comic Sans MS";
        }
        .timerPosition
        {
            position: absolute;
            top: 375px;
            left: 50px;
            font-size: 20px;
            font-family: "Comic Sans MS";
        }
        .tapPosition
        {
            position: absolute;
            top: 400px;
            left: 50px;
            font-size: 20px;
            font-family: "Comic Sans MS";
        }
        .panel
        {
            background: limegreen;
            height: 530px;
            width: 400px;
        }

        .start_button {
            position:absolute;
            background-color: #008CBA; /*Blue*/
            border-radius: 8px;
            color: white;
            padding: 16px 40px;
            text-align: center;
            text-decoration: none;
            font-size: 20px;
            top:30px;
            left:210px;
            display: block;
        }

        .sellBLocation
        {
            position: absolute;
            top: 435px;
            left: 100px;
            display: none;
        }
        .keepBLocation
        {
            position: absolute;
            top: 432px;
            left: 200px;
            display: none;
        }
        .b {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 15px 32px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            position:absolute;
            top:80px;
            left:30px;
        }


    </style>
</head>
<body>


<div class="panel">

    <h3 id="goldM" class="goldMPosition">Your Gold: <?php echo $gold?></h3>
    <p id = "timer" class="timerPosition">Timer: 15</p>
    <p id = "tapCount" class="tapPosition">Taps: 0 </p>
    <p id= "text" class="textM"></p>

    <div style="position: relative; left: 0; top: 0;">
        <img src="eggPlant2_files\nest1.png" class="nest"/>
        <span id="tapArea"><img  id = "egg10" src="eggPlant2_files\ultrarare_blueegg.png" class="eggLocation"/></span>
    </div>
    <button onclick="set_timer()" id='start_button' class="start_button">Play Now!</button>
    <a href="Homepage.php"><button class="b">Home</button></a>
</div>
<img  id = "sellB" src="eggPlant2_files\sprite_sell_0.png" onclick="sell()" class="sellBLocation"/>
<img  id = "keepB" src="eggPlant2_files\sprite_keep_0.png"  class="keepBLocation"/>




<script>

    var game = {
        time:<?php echo $data['time']?>,
        gold:<?php echo $gold?>,
        level1animalb:<?php echo $data['level1animalb']?>,
        level2animalb:<?php echo $data['level2animalb']?>,
        level3animalb:<?php echo $data['level3animalb']?>,
        level4animalb:<?php echo $data['level4animalb']?>,
        lessclickb:<?php echo $data['lessclickb']?>,
        minlevel1clickb:<?php echo $data['minlevel1clickb']?>,
        maxlevel1clickb:<?php echo $data['maxlevel1clickb']?>,
        minlevel2clickb:<?php echo $data['minlevel2clickb']?>,
        maxlevel2clickb:<?php echo $data['maxlevel2clickb']?>,
        minlevel3clickb:<?php echo $data['minlevel3clickb']?>,
        maxlevel3clickb:<?php echo $data['maxlevel3clickb']?>,
        minlevel4clickb:<?php echo $data['minlevel4clickb']?>,
        crack4Imgb:<?php echo $data['crack4Imgb']?>,
        basePathb:<?php echo $data['basePathb']?>,
        framNumlevel1b:<?php echo $data['framNumlevel1b']?>,
        framNumlevel2b:<?php echo $data['framNumlevel2b']?>,
        framNumlevel3b:<?php echo $data['framNumlevel3b']?>,
        framNumlevel4b:<?php echo $data['framNumlevel4']?>,
        level1TxtMsgb:<?php echo $data['level1TxtMsgb']?>,
        level2TxtMsgb:<?php echo $data['level2TxtMsgb']?>,
        level3TxtMsgb:<?php echo $data['level3TxtMsgb']?>,
        level4TxtMsgb:<?php echo $data['level4TxtMsgb']?>
    };

    var tapArea = document.getElementById("tapArea");
    var x = 0;
    //var button = document.getElementById("start_button");
    tapArea.addEventListener("click", addUp, false);


    //var Game_time = 15;
    var game_start = false;
    function set_timer() {
        game_start = true;
    }
    var timer_countdown= setInterval(function (){
        if(game_start == true){
            document.getElementById('start_button').style.display = 'none';
            document.getElementById("timer").innerHTML = "Timer: " + game.time;
            game.time -= 1;
            if(game.time == 0){
                document.getElementById("timer").innerHTML = "Timer: " + "Time's Up!";
                clearInterval(timer_countdown);
                x = x - 1;
                game_start = false;
                if(x>=game.minlevel1clickb&&x<=game.maxlevel1clickb){
                    document.getElementById("egg10").src = game.basePathb + game.crack4Imgb;
                    Game_animal= game.level1animalb;
                    Game_basePath= game.basePathb;
                    Game_frameNum = game.framNumlevel1b;
                    text.innerHTML = game.level1TxtMsgb;
                    createAnimal();
                }
                else if(x>=game.minlevel2clickb&&x<= game.maxlevel2clickb) {
                    document.getElementById("egg10").src = game.basePathb + game.crack4Imgb;
                    Game_animal = game.level2animalb;
                    Game_basePath = game.basePathb;
                    Game_frameNum = game.framNumlevel2b;
                    text.innerHTML = game.level2TxtMsgb;
                    createAnimal();
                }
                else if(x>=game.minlevel3clickb&&x<= game.maxlevel3clickb){
                    document.getElementById("egg10").src = game.basePathb + game.crack4Imgb;
                    Game_animal= game.level3animalb;
                    Game_basePath= game.basePathb;
                    Game_frameNum = game.framNumlevel3b;
                    text.innerHTML = game.level3TxtMsgb;
                    createAnimal();
                }
                else if(x>=game.minlevel4clickb){
                    document.getElementById("egg10").src = game.basePathb + game.crack4Imgb;
                    Game_animal= game.level4animalb;
                    Game_basePath= game.basePathb;
                    Game_frameNum = game.framNumlevel4b;
                    text.innerHTML = game.level4TxtMsgb;
                    createAnimal();
                }
                else if(x<=game.lessclickb){
                    document.getElementById("egg10").src = game.basePathb + game.crack4Imgb;
                    text.innerHTML = "<b>You Lose! Play Again?</b>";
                }
            }
        }
    }, 1000);
    function addUp(){
        document.getElementById("tapCount").innerHTML = "Taps: " + x;
        if (game_start == true){
            x = x + 1;
            if (x>10) {
                document.getElementById("egg10").src = "eggPlant2_files\\ultrarare_blueegg_crack1.png"
                text.innerHTML = "<b>Tap Faster!</b>";
            }
            if (x>20) {
                document.getElementById("egg10").src = "eggPlant2_files\\ultrarare_blueegg_crack2.png"
                text.innerHTML = "<b>Keep Going!</b>";
            }
            if (x>30) {
                document.getElementById("egg10").src = "eggPlant2_files\\ultrarare_blueegg_crack3.png"
                text.innerHTML = "<b>Almost There!</b>";

            }
        }
    }

    function createAnimal() {
        var y = document.createElement("IMG");
        var str = Game_basePath + Game_animal + "_frame1.png";
        y.setAttribute("src", str);
        y.setAttribute("id", "animal");
        y.setAttribute("class", "animalLocation");
        document.body.appendChild(y);
        setInterval(frame, 500);
        document.getElementById('sellB').style.display = 'block';
        //document.getElementById('keepB').style.display = 'block';
    }
    var curFrame = 1;
    function frame() {
        var str = Game_basePath + Game_animal + "_frame" + curFrame + ".png";
        document.getElementById("animal").src = str;
        curFrame += 1;
        if (curFrame > Game_frameNum)
            curFrame = 1;
    }
    var gold =  <?php echo $gold?>;
    var gold_c = <?php echo $gold_c?>;
    var gold_l = <?php echo $gold_l?>;
    var gold_di = <?php echo $gold_di?>;
    var gold_de = <?php echo $gold_de?>;


    function sell(){
        document.getElementById('sellB').style.display = 'none';
        document.getElementById('animal').style.display = 'none';
        text.innerHTML = "<b>You sold your animal! </br> Buy another egg to play!</b>";
        if(x>=game.minlevel1clickb&&x<=game.maxlevel1clickb){
            var newGold = gold + gold_c;
            goldM.innerHTML = "Your Gold: " + newGold;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + newGold , true);
            xmlhttp.send();
        }
        else if(x>=game.minlevel2clickb&&x<= game.maxlevel2clickb){
            var newGold = gold + gold_l;
            goldM.innerHTML = "Your Gold: " + newGold;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + newGold , true);
            xmlhttp.send();
        }
        else if(x>=game.minlevel3clickb&&x<= game.maxlevel3clickb){
            var newGold = gold + gold_di;
            goldM.innerHTML = "Your Gold: " + newGold;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + newGold , true);
            xmlhttp.send();
        }
        else if(x>=game.minlevel4clickb){
            var newGold = gold + gold_de;
            goldM.innerHTML = "Your Gold: " + newGold;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "SQL_UpdateGold.php?Gold=" + newGold , true);
            xmlhttp.send();
        }

    }



</script>
</body>

