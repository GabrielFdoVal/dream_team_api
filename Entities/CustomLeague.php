<?php
    class CustomLeague {
        public String $id;
        public String $name;
        public String $rounds;
        public String $userLength;
        public String $private;

        function __construct($id, $name, $rounds, $userLength, $private){
            $this->id = $id;
            $this->name = $name;
            $this->rounds = $rounds;
            $this->userLength = $userLength;
            $this->private = $private;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }