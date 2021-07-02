<?php  
    require ("MonHoc.php");
    require ("HocPhan.php");
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
    //echo var_dump($mhoc);
    

    $hp = [];
    
    for ($i=0; $i < count(locmon($hocphan)); $i++)
    {
        $hp2 = [];
        if ($mhoc[$i]->getCheckLT() == 1)
        {
            for ($j=0 ; $j < count($mhoc[$i]->getHocPhan()); $j++)
            {
                if ($mhoc[$i]->getHocPhan()[$j]->getThucHanh() == 0)
                {
                    array_push($hp2, [$i, $j]);
                }
            }
        }
        if (!empty($hp2))
        {
            array_push($hp, $hp2);
            $hp2 = [];
        }
            
        if ($mhoc[$i]->getCheckTH() == 1)
        {
            for ($j=0 ; $j < count($mhoc[$i]->getHocPhan()); $j++)
            {
                if ($mhoc[$i]->getHocPhan()[$j]->getThucHanh() == 1)
                {
                    array_push($hp2, [$i, $j]);
                }
            }
        }
        if (!empty($hp2))
            array_push($hp, $hp2);
    }

    //echo var_dump($hp);

    $checkcunggiaovien = 0;

    $th = [];
    $th2 = [];  
    for ($i=0; $i < count($hp); $i++)
    {
        if (count($hp[$i]) > 1)
        {
            $th3 = $th;
            for ($j=0; $j < count($hp[$i]); $j++)
                array_push($th, $th3);
        }
        if (checkTHduoi($i, $hp, $mhoc))
        {
            for ($j=0; $j < count($hp[$i]); $j++)
            {
                if (checkGVduoi($j, $hp, $mhoc))
                    echo $i. ' '.$j;
            }
        }
        
    }
        
    function getTHduoi($a, $hp, $mhoc)
    {

    }
/*
    function checkGVduoi($a, $hp, $mhoc)
    {
        echo $hp[$a][0][0];
        for ($i=0; $i < $hp[$a + 1]; $i++)
            if ($mhoc[$hp[$a+1][$i][0]]->getHocPhan()[$hp[$a+1][$i][1]]->getGiaoVien() ==  $mhoc[$hp[$a][0][0]]->getHocPhan()[$hp[$a][0][1]]->getGiaoVien())
                return true;
        return false;
    }
    */

    function checkTHduoi($a, $hp, $mhoc)
    {
        if (!isset($hp[$a + 1][0][0])  || $mhoc[$hp[$a][0][0]]->getHocPhan()[0]->getMaHocPhan() !=  $mhoc[$hp[$a + 1][0][0]]->getHocPhan()[0]->getMaHocPhan())
            return false;
        return true;
    }
    
    /*
    // chia nhóm
    $nhom = [];
    $groupid = 0;
    $focusid = "";
    for ($i=0; $i < count($hocphan); $i++)
    {
        if ($focusid == $hocphan[$i]->getMaHocPhan())
        {
            $nhom[$i] = $groupid;
        }
        else
        {
            $focusid = $hocphan[$i]->getMaHocPhan();
            $groupid++;
            $nhom[$i] = $groupid;
        }
    }

    // Duyệt trường hợp thỏa mãn
    
    $tkb = [];
    $loadall = 0;
    $c_focus = 0;

    while ($loadall == 1)
    {
        cleartkb();
        

    }
    */

    function cleartkb()
    {
        for ($i=0; $i < 8; $i++)
            for ($j=0; $j < 12; $j++)
                $tkb[$i][$j] = 0;
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