<?php
    session_start();
    if (!isset($_POST['id']) || !isset($_SESSION['al']))
        return;
    $id =  $_POST['id'];
    $al =  $_SESSION['al'];
    echo $al[$id];
?>