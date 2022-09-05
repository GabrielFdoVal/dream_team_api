<?php
    class SponsorLeague {
        public int $id;
        public String $name;

        function __construct($id, $name){
            $this->id = $id;
            $this->name = $name;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }