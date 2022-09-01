<?php
    class User {
        private int $id;
        public String $name;
        public String $email;
        public String $password;
        public String $birthday;

        function __construct($name, $email, $password, $birthday){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;
        }

        public function expose(): array
        {
            return get_object_vars($this);
        }
    }