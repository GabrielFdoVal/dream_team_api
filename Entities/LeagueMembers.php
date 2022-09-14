<?php
    class LeagueMember {
        public String $nickname;
        public String $point;
        public String $position;

        function __construct($nickname, $point, $position){
            $this->nickname = $nickname;
            $this->point = $point;
            $this->position = $position;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }