<?php
    class User {
        private int $id;
        public String $name;
        public String $email;
        public String $birthday;
        public String $leonita;
        public String $ametista;
        public String $password;
        public String $nickname;
        public String $point;
        public int $sponsorsLeague;


        function __construct($name, $email, $birthday, $leonita, $ametista, $password, $nickname, $point, $sponsorsLeague){
            $this->name = $name;
            $this->email = $email;            
            $this->birthday = $birthday;
            $this->leonita = $leonita;
            $this->ametista = $ametista;
            $this->password = $password;
            $this->password = $password;
            $this->nickname = $nickname;
            $this->point = $point;
            $this->sponsorsLeague = $sponsorsLeague;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }