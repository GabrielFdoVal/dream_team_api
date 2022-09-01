<?php
    class User {
        public $id;
        public $name;
        public $email;
        public $password;
        public $birthday;

        function SignUp($name, $email, $password, $birthday){
            require('../conection.php');
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;
            $this->id = $this->newId();

            $insert_sql = "INSERT INTO tb_usuario VALUES ($this->id, '$this->name', '$this->email', '$this->password', 0, 0, '$this->password', 'teste', 0, null);";
            try {
                $res_insert = $link->query($insert_sql, MYSQLI_USE_RESULT);
            } catch (Exception $e) {
                return 500;
            }
            $link->close();

            if($res_insert){
                return 200;
            } else {
                return 400;
            }
        }

        function newId(){
            require('../conection.php');
            $sql = "SELECT MAX(cd_usuario) FROM tb_usuario";
            $res = $link->query($sql, MYSQLI_USE_RESULT);
    
            if($res){
                $dados = json_encode($res->fetch_object());
                $json = json_decode($dados,true);
                $max = $json['MAX(cd_usuario)'] + 1;
                $link->close();
                return $max;
            }
            return -1;
        }

        function SignIn($email, $password){
            require("../conection.php");
            $sql = "SELECT cd_email, nm_senha FROM tb_usuario WHERE cd_email = '$email'";
            try {
                $res = $link->query($sql, MYSQLI_USE_RESULT);
            } catch (Exception $e) {
                return 500;
            }
            
            $user = json_encode($res->fetch_object());
            $link->close();

            if($user !== 'null'){
                $userJson = json_decode($user, true);
                if($userJson['nm_senha'] !== $password){
                    return 400;
                } else {
                    return 200;
                }
            } else {
                return 400;
            }
        }
    }
?>