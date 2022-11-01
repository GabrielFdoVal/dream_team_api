<?php
    class CustomLeague {
        public String $id;
        public String $name;
        public String $rounds;
        public String $userLength;
        public String $private;
        public String $code;

        function __construct($id, $name, $rounds, $userLength, $private, $code){
            $this->id = $id;
            $this->name = $name;
            $this->rounds = $rounds;
            $this->userLength = $userLength;
            $this->private = $private;
            $this->code = $code;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }