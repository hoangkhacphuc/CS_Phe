<?php  
    require ("MonHoc.php");
    session_start();
    if (!isset($_SESSION['class']))
        return;
    $mon = $_SESSION['class'];
    $hocphan = new MonHoc();
    for ($i=0; count($mon); $i++)
    {
        //if ($mon[$i ])
    }
?>