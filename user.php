<?php
    class User {
        public int $id;
        public String $name;
        public String $email;
        public String $password;
        public String $birthday;

        // function __construct($id, $name, $email, $password, $birthday){
        //     this.$id = $id;
        //     this.$name = $name;
        //     this.$email = $email;
        //     this.$password = $password;
        //     this.$birthday = $birthday;
        // }

        function sign_up($id, $name, $email, $password, $birthday){
            this.$id = $id;
            this.$name = $name;
            this.$email = $email;
            this.$password = $password;
            this.$birthday = $birthday;            
        }
    }
?>