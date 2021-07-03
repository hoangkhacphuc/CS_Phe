<?php
    require ("MonHoc.php");
    require ("HocPhan.php");
    require ("TKB.php");
    session_start();
    if (!isset($_GET['ca']) || !isset($_GET['gv']) || !isset($_SESSION['tenhp']) || !isset($_SESSION['tkb']) || !isset($_SESSION['idmon']) || !isset($_SESSION['kqd']) || !isset($_SESSION['gv']))
        return;
    $output = $_SESSION['tkb'];
    $idhocphan = $_SESSION['idmon'];
    $tenhp = $_SESSION['tenhp'];
    $kqdung = $_SESSION['kqd'];
    $gv = $_SESSION['gv'];
    $uca = $_GET['ca'];
    $ugv = $_GET['gv'];
    $tb = [];
    $danhsach = $output;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="cs.css">
        <script src="cs.js"></script>
        <link rel="stylesheet" type="text/css" href="tkb.css">
        <script src="tkb.js"></script>
        <link href="lg.png" rel="shortcut icon" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <center>
            <?php
                for ($i=0; $i < count($danhsach); $i++)
                {
                    $tb[$i] = "";
                    for ($z=0; $z < count($kqdung[$i]); $z++)
                    {
                        $tb[$i] .= ">>> ".$kqdung[$i][$z]->getTenLop()." --- ".$kqdung[$i][$z]->getGiaoVien()."\n";
                    }

                    $temp = $danhsach[$i];
                    echo "<div class='thoikhoabieu'><table id='".$i."' onclick='tb(this.id)'><tr>
                            <th>Tiết</th>
                            <th>Thứ 2</th>
                            <th>Thứ 3</th>
                            <th>Thứ 4</th>
                            <th>Thứ 5</th>
                            <th>Thứ 6</th>
                            <th>Thứ 7</th>
                            <th>Chủ Nhật</th>
                        </tr>";
                    for ($a=0; $a < 10; $a++)
                    {
                        echo "<tr><td>".($a+1)."</td>";
                        for ($b=0; $b < 7; $b++)
                        {
                            if ($temp[$a][$b] != 0)
                                echo "<td class='color".$temp[$a][$b]."'></td>";
                            else echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table><div class='note'>";
                    for ($p=0; $p < count($idhocphan); $p++)
                        echo "<div class='item'><span class='color".($p+1)."'></span>".$tenhp[$p]."</div>";
                    echo "</div></div>";
                    
                }

                $_SESSION['al'] = $tb;
            ?>
        </center>
    </body>
</html>