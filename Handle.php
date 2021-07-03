<?php  
    require ("MonHoc.php");
    require ("HocPhan.php");
    require ("TKB.php");
    session_start();
    if (!isset($_SESSION['class']))
        return;
    $mon = $_SESSION['class'];
    $hocphan = [];
    $num = 0;
    
    // Lọc môn đã hết chỗ
    for ($i=0; $i < count($mon); $i++)
    {
        if ( intval($mon[$i]->getConTrong()) != 0)
        {
            $hocphan[$num] = $mon[$i];
            $num++;
        }
    }
    if (count(locmon($hocphan)) != count(locmon($mon)))
    {
        $strout = "Tìm thấy ".(count(locmon($mon)) - count(locmon($hocphan)))." môn học không còn chỗ trống !";
        $out =  array($strout);
        echo json_encode($out);
        return;
    }

    sort($hocphan);     // sắp xếp  theo mã học phần
    
    $mhoc = [];  // lưu mảng chứa các nhóm môn

    for ($i =0; $i < count(locmon($hocphan)); $i++)
    { 
        $k = new HocPhan();  // lưu class Học Phần mới
        $q = [];  // lưu học phần cùng mã học phần
        for ($j=$i; $j < count($hocphan); $j++)
        {
            if ($hocphan[$j]->getMaHocPhan() == locmon($hocphan)[$i])
            {
                array_push($q, $hocphan[$j]);
            }
        }
        $k->setHocPhan($q);
        array_push($mhoc, $k);
    }

    //echo print_r($mhoc);
    for ($i=0; $i < count($mhoc); $i++)
    {
        $k = $mhoc[$i];

        for ($j=0; $j < count($k->getHocPhan()); $j++)
        {
            if ($k->getHocPhan()[$j]->getThucHanh() == 1)
            {
                $k->setCheckTH(1);
            }
            else
            {
                $k->setCheckLT(1);
            }
        }

        $mhoc[$i] = $k;
    }
    //echo print_r($mhoc);

    $smon = [];  // mảng chứa các th

    for ($p=0; $p < count(locmon($hocphan)); $p++)
    {
        $k = $mhoc[$p];
        $kq = [];

        if ( ($k->getCheckLT() && !$k->getCheckTH()) || (!$k->getCheckLT() && $k->getCheckTH()) )
        {
            $kq = $k->getHocPhan();
            array_push($smon, $kq);
        }
        else if (count($k->getHocPhan()) == 2)
        {
            $kq = $k->getHocPhan();
            array_push($smon, $kq);
        }
        else
        {
            for ($i=0; $i < count($k->getHocPhan()); $i++)
            {
                if ($k->getHocPhan()[$i]->getThucHanh() == 0)
                {
                    if (checkGV($k, $i))
                    {
                        for ($j=0; $j < count($k->getHocPhan()); $j++)
                        {
                            if ($i != $j && $k->getHocPhan()[$i]->getGiaoVien() == $k->getHocPhan()[$j]->getGiaoVien() && $k->getHocPhan()[$j]->getThucHanh() == 1)
                            {
                                array_push($kq, [$k->getHocPhan()[$i], $k->getHocPhan()[$j]]);
                            }
                        }
                        
                    }
                    else
                    {
                        for ($j=0; $j < count($k->getHocPhan()); $j++)
                        {
                            if ($i != $j && $k->getHocPhan()[$j]->getThucHanh() == 1)
                                array_push($kq, [$k->getHocPhan()[$i], $k->getHocPhan()[$j]]);
                        }
                        //echo print_r($k->getHocPhan());
                    }
                }
            }
            array_push($smon, $kq);
        }
    }
    
    //echo print_r($smon);

    $kmon = []; // mảng chứa list các TH

    for ($i=0; $i < count($smon); $i++)
    {
        if (count($smon[$i]) > 1 && is_array($smon[$i][0]))
        {
            $q = $kmon;
            for ($j=0; $j<(count($smon[$i]) - 1); $j++)
            $kmon = array_merge($kmon, $q);
            
            $n = 0;
            for ($j=0; $j<count($kmon); $j++)
            {
                if ($j == ($n+1)*(count($kmon) / count($smon[$i])))
                    $n++;
                //echo print_r($smon[$i][$n]);
                array_push($kmon[$j], $smon[$i][$n][0]);
                array_push($kmon[$j], $smon[$i][$n][1]);
            }
            //echo print_r($kmon);
        }
        else if (count($smon[$i]) > 1)
        {
            for ($j=0; $j<count($kmon); $j++)
            {
                array_push($kmon[$j], $smon[$i][0]);
                array_push($kmon[$j], $smon[$i][1]);
            }
        }
        else if (empty($kmon))
        { 
            array_push($kmon, []);
            array_push($kmon[0], $smon[$i][0]);   
        }
        else
        {
            for ($j=0; $j<count($kmon); $j++)
            {   
                array_push($kmon[$j], $smon[$i][0]);
            }
            
        }
        
    }

    //echo print_r($kmon);

    $lichhoc = [];  // chứa danh sách các TH đúng

    $settkb = [
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0]
    ];


    xemten($hocphan);

    $monn = locmon($hocphan);
    $idhocphan = [];
    for ($i=1; $i <= count($monn); $i++)
        $idhocphan[locmon($hocphan)[$i-1]] = $i;
    //echo var_dump($kmon);
    
    for ($i=0; $i < count($kmon); $i++)
    {
        $check = 0;
        //echo count($kmon)." ".count($kmon[$i])."\n";
        for ($j=0; $j < count($kmon[$i]); $j++)
        {
            for ($x=0; $x < count($kmon[$i][$j]->getLichHoc()); $x++)
            {
                for ($y = getLich($kmon[$i][$j]->getLichHoc()[$x])[1] - 1 ; $y < getLich($kmon[$i][$j]->getLichHoc()[$x])[2]; $y++)
                {
                    if ($settkb[$y][getLich($kmon[$i][$j]->getLichHoc()[$x])[0] - 2] != 0)
                    {
                        $check == 1;
                        break;
                    }
                    else $settkb[$y][getLich($kmon[$i][$j]->getLichHoc()[$x])[0] - 2] = $idhocphan[$kmon[$i][$j]->getMaHocPhan()];
                }
                if ($check == 1)
                    break;
            }
            if ($check == 1)
                    break;
        }
        if ($check == 0)
        {
            $z = new TKB();
            $z->setLich($settkb);
            array_push($lichhoc, $z);
            xemlich($settkb);
            $settkb = cleartkb($settkb);
            
        }
    }
    
    //echo print_r($z);

    function xemten($a)
    {
        $arr = [];
        $arr2 = [];
        for ($i=0;$i < count($a);$i++)
        {
            if (!in_array($a[$i]->getMaHocPhan(), $arr))
            {
                array_push($arr,$a[$i]->getMaHocPhan());
                array_push($arr2,$a[$i]->getTenLop());
            }
        }
        for ($i=0;$i < count($arr2);$i++)
            echo $i."    ".$arr2[$i]."\n";
        echo "\n";

    }
    function xemlich($settkb)
    {
        for ($i=0; $i < 10; $i++)
        {
            for ($j=0; $j < 7; $j++)
                echo $settkb[$i][$j]." ";
            echo "\n";
        }
        echo "\n";
    }

    // Thứ 2(T8-10)
    function getLich($str)
    {
        $str2 = explode("(", $str);
        $strthu = strtolower($str2[0]);
        $thu = 2;

        if ($strthu == "thứ 3")
            $thu = 3;
        else if ($strthu == "thứ 4")
            $thu = 4;
        else if ($strthu == "thứ 5")
            $thu = 5;
        else if ($strthu == "thứ 6")
            $thu = 6;
        else if ($strthu == "thứ 7")
            $thu = 7;
        else if ($strthu == "chủ nhật")
            $thu = 8;

        $t1 = 1;
        $t2 = 1;

        $strtiet = chop($str2[1], ")");
        $strtiet2 = explode("T", $strtiet)[1];
        $arrtiet = explode("-", $strtiet2);
        $t1 = intval($arrtiet[0]);
        $t2 = intval($arrtiet[1]);

        return [$thu, $t1, $t2];
    }

    function checkGV($k , $a)
    {
        for ($i=0; $i < count($k->getHocPhan()); $i++)
        {
            if ($a != $i && $k->getHocPhan()[$i]->getGiaoVien() == $k->getHocPhan()[$a]->getGiaoVien() && $k->getHocPhan()[$i]->getThucHanh() == 1)
                return true;
        }
        return false;
    }

    function cleartkb($settkb)
    {
        for ($i=0; $i < 10; $i++)
            for ($j=0; $j < 8; $j++)
                $settkb[$i][$j] = 0;
        return $settkb;
    }

    function locmon($a)
    {
        $arr = [];

        for ($i=0;$i < count($a);$i++)
        {
            if (!in_array($a[$i]->getMaHocPhan(), $arr))
            {
                array_push($arr,$a[$i]->getMaHocPhan());
            }
        }
        return $arr;
    }
    
?>