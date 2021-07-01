<?php  
    require ("MonHoc.php");
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
    if (locmon($hocphan) != locmon($mon))
    {
        $strout = "Tìm thấy ".(locmon($mon) - locmon($hocphan))." môn học không còn chỗ trống !";
        $out =  array($strout);
        echo json_encode($out);
        return;
    }

    sort($hocphan);     // sắp xếp  theo mã học phần
    //echo var_dump($hocphan);
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
        return count($arr);
    }
?>