<?php
    class MatchModel {
        public int $id;
        public String $startDate;
        public String $endDate;

        function __construct($id, $startDate, $endDate){
            $this->id = $id;
            $this->startDate = $startDate;            
            $this->endDate = $endDate;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }