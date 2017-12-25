<?php
    session_start();
    $_SESSION['username'] = false;
    header("Location: SQL_NewUser.php");
?>