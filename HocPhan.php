<?php
    class HocPhan{
        private $Mon = [];
        private $CheckLT = 0;
        private $CheckTH = 0;

        // SET
        function setHocPhan($a)
        {
            $this->Mon = $a;
        }

        function setCheckLT($a)
        {
            $this->CheckLT = $a;
        }

        function setCheckTH($a)
        {
            $this->CheckTH = $a;
        }
        // GET
        function getHocPhan()
        {
            return $this->Mon;
        }

        function getCheckLT()
        {
            return $this->CheckLT;
        }

        function getCheckTH()
        {
            return $this->CheckTH;
        }
    }
?>