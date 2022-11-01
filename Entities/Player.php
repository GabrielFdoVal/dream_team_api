<?php
    class Player {
        public ?String  $id;
        public ?String $name;
        public ?String $position;
        public ?String $point;
        public ?String $rebound;
        public ?String $block;
        public ?String $steal;
        public ?String $assist;
        public ?String $missShot;
        public ?String $turnOver;
        public ?String $imgUrl;
        public ?String $price;
        public ?String $team;


        function __construct($id, $name, $position, $point, $rebound, $block, $steal, $assist, $missShot, $turnOver, $imgUrl, $price, $team){
            $this->id = $id;
            $this->name = $name;
            $this->position = $position;            
            $this->point = $point;
            $this->rebound = $rebound;
            $this->block = $block;
            $this->steal = $steal;
            $this->assist = $assist;
            $this->missShot = $missShot;
            $this->turnOver = $turnOver;
            $this->imgUrl = $imgUrl;
            $this->price = $price;
            $this->team = $team;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }