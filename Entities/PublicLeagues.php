<?php
    class PublicLeagues {
        public String $id;
        public String $name;
        public String $creator;
        public String $userLength;

        function __construct($id, $name, $creator, $userLength){
            $this->id = $id;
            $this->name = $name;
            $this->creator = $creator;
            $this->userLength = $userLength;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }