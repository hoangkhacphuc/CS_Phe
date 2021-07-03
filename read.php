<?php
    session_start();
    $input = file_get_contents('php://input');
    if ($input=="")
        return;
    $json = json_decode($input, true);
    
    require ("MonHoc.php");
    $checkFileTinChi = false;
    $mon = [];
    $sum_subject = 0;
    $num = 0;
    $cahoc = [];
    $phonghoc = [];
    $lichhoc = [];
    for ($i=0;$i<count($json);$i++)
    {
        if (isset($json[$i]["Mã học phần"]))
        {
            $checkFileTinChi = true;
            if ($num != 0)
            {
                $num = 0;
                $mon[$sum_subject-1]->setCaHoc($cahoc);
                $mon[$sum_subject-1]->setLichHoc($lichhoc);
                $mon[$sum_subject-1]->setPhongHoc($phonghoc);
                
                $cahoc = [];
                $phonghoc = [];
                $lichhoc = [];
            }
            $mon[$sum_subject] = new MonHoc();
            $mon[$sum_subject]->setMaHocPhan($json[$i]["Mã học phần"]);
            $mon[$sum_subject]->setTenHocPhan($json[$i]["Tên học phần"]);
            $mon[$sum_subject]->setTenLop($json[$i]["Tên lớp tín chỉ"]);
            $cahoc[0] = $json[$i]["Ca học"];
            $mon[$sum_subject]->setNgayHoc($json[$i]["Lịch học"]);
            if (isset($json[$i]["Giáo viên"]))
                $mon[$sum_subject]->setGiaoVien($json[$i]["Giáo viên"]);
            else $mon[$sum_subject]->setGiaoVien(" ");
            $phonghoc[0] = $json[$i]["Phòng học"];
            $mon[$sum_subject]->setConTrong($json[$i]["Còn trống"]);
            
            $sum_subject = $sum_subject + 1;
        }
        else
        {
            $num++;
            if (isset($json[$i]["Ca học"]))
            {
                $cahoc[$num] = $json[$i]["Ca học"];
                $phonghoc[$num] = $json[$i]["Phòng học"];
            }
            $lichhoc[$num-1] = $json[$i]["Lịch học"];
        }
    }
    if ($num != 0 && $checkFileTinChi)
    {
        $num = 0;
        $mon[$sum_subject-1]->setCaHoc($cahoc);
        $mon[$sum_subject-1]->setLichHoc($lichhoc);
        $mon[$sum_subject-1]->setPhongHoc($phonghoc);
    }
    if (!$checkFileTinChi)
    {
        echo "Không thể tìm thấy lớp tín chỉ. Hãy đảm bảo copy cả phần tiêu đề của danh sách lớp tín chỉ !";
        return;
    }
    $_SESSION['class'] = $mon;
    $arr = [];

    for ($i=0;$i < $sum_subject;$i++)
    {
        if (!in_array($mon[$i]->getGiaoVien(), $arr))
        {
            array_push($arr,$mon[$i]->getGiaoVien());
        }
    }
    echo json_encode($arr);
?>