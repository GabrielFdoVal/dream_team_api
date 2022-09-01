<?php
    class ResultService{
        public int $Status;
        public ?String $Data;
        public ?String $Message;

        public function Ok($Status, $Data){
            $this->Status = $Status;
            $this->Data = $Data;
        }

        public function Fail($Status, $Message){
            $this->Status = $Status;
            $this->Message = $Message;
        }
    }