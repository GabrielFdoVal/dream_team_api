<?php
    class CustomLeague {
        public String $id;
        public String $name;
        public String $rounds;
        public String $userLength;
        public String $private;
        public String $code;
        public String $points;
        public String $creator;

        function __construct($id, $name, $rounds, $userLength, $private, $code, $points, $creator){
            $this->id = $id;
            $this->name = $name;
            $this->rounds = $rounds;
            $this->userLength = $userLength;
            $this->private = $private;
            $this->code = $code;
            $this->points = $points;
            $this->creator = $creator;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }