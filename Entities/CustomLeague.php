<?php
    class CustomLeague {
        public String $id;
        public String $name;
        public String $rounds;
        public String $userLength;
        public String $private;
        public String $code;
        public String $points;
        public String $entry;
        public String $creator;
        public String $players;

        function __construct($id, $name, $rounds, $userLength, $private, $code, $points, $entry, $creator, $players){
            $this->id = $id;
            $this->name = $name;
            $this->rounds = $rounds;
            $this->userLength = $userLength;
            $this->private = $private;
            $this->code = $code;
            $this->points = $points;
            $this->entry = $entry;
            $this->creator = $creator;
            $this->players = $players;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }