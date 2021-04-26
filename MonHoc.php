<?php
    class MonHoc {
        private $MaHocPhan;
        private $TenHocPhan;
        private $TenLop;
        private $CaHoc = [];
        private $NgayHoc;
        private $LichHoc = [];
        private $GiaoVien;
        private $PhongHoc = [];
        private $ConTrong;
        private $ThucHanh = 0;
        // SET
        function setMaHocPhan($mhp)
        {
            $this->MaHocPhan = $mhp;
        }
        function setTenHocPhan($thp)
        {
            $this->TenHocPhan = $thp;
        }
        function setTenLop($tl)
        {
            $this->TenLop = $tl;
            if (substr($tl, strlen($tl)-2, strlen($tl)-1) == "TH")
                $this->setThucHanh(1);
        }
        function setCaHoc($ch)
        {
            $this->CaHoc = $ch;
        }
        function setNgayHoc($nh)
        {
            $this->NgayHoc = $nh;
        }
        function setLichHoc($lh)
        {
            $this->LichHoc = $lh;
        }
        function setGiaoVien($gv)
        {
            $this->GiaoVien = $gv;
        }
        function setPhongHoc($ph)
        {
            $this->PhongHoc = $ph;
        }
        function setConTrong($ct)
        {
            $this->ConTrong = $ct;
        }
        function setThucHanh($th)
        {
            $this->ThucHanh = $th;
        }
        // GET
        function getMaHocPhan()
        {
            return $this->MaHocPhan;
        }
        function getTenHocPhan()
        {
            return $this->TenHocPhan;
        }
        function getTenLop()
        {
            return $this->TenLop;
        }
        function getCaHoc()
        {
            return $this->CaHoc;
        }
        function getNgayHoc()
        {
            return $this->NgayHoc;
        }
        function getLichHoc()
        {
            return $this->LichHoc;
        }
        function getGiaoVien()
        {
            return $this->GiaoVien;
        }
        function getPhongHoc()
        {
            return $this->PhongHoc;
        }
        function getConTrong()
        {
            return $this->ConTrong;
        }
        function getThucHanh()
        {
            return $this->ThucHanh;
        }
    }
?>