<?php
    class Admin {
        private int $id;
        public String $name;
        public String $email;
        public String $birthday;
        public String $password;

        function __construct($name, $email, $birthday, $password,){
            $this->name = $name;
            $this->email = $email;            
            $this->birthday = $birthday;
            $this->password = $password;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }