<?php
    class User {
        public $id;
        public $name;
        public $email;
        public $password;
        public $birthday;

        function SignUp($name, $email, $password, $birthday){
            require('../conection.php');
            $id = $this->getId(true);
            if($id != -1){
                $this->SetUser($id, $name, $email, $password, $birthday);

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
            } else {
                return 500;
            }
            
        }

        function getId($newId){
            require('../conection.php');
            $sql = "SELECT MAX(cd_usuario) FROM tb_usuario";
            try {
                $res = $link->query($sql, MYSQLI_USE_RESULT);
            } catch (Exception $e){
                return -1;
            }            
    
            if($res){
                $dados = json_encode($res->fetch_object());
                $json = json_decode($dados,true);
                $max = $json['MAX(cd_usuario)'];
                $link->close();
                if($newId){
                    return $max + 1;
                }
                return $max;
            }
            return -1;
        }

        function SignIn($email, $password){
            require("../conection.php");
            $sql = "SELECT * FROM tb_usuario WHERE cd_email = '$email' AND nm_senha = '$password'";
            try {
                $res = $link->query($sql, MYSQLI_USE_RESULT);
            } catch (Exception $e) {
                return 500;
            }
            
            $user = json_encode($res->fetch_object());
            $link->close();

            if($user !== 'null'){
                $userJson = json_decode($user, true);
                $this->SetUser($userJson['cd_usuario'],$userJson['nm_usuario'],$userJson['cd_email'],$userJson['nm_senha'],$userJson['dt_nascimento']);
                return 200;
            } else {
                return 400;
            }
        }

        function validateEmail($email){
            require("../conection.php");
            $sql = "SELECT * FROM tb_usuario WHERE cd_email = '$email'";
            try {
                $res = $link->query($sql, MYSQLI_USE_RESULT);
            } catch (Exception $e) {
                return 500;
            }
            
            $user = json_encode($res->fetch_object());
            $link->close();

            if($user !== 'null'){
                $userJson = json_decode($user, true);
                $this->SetUser($userJson['cd_usuario'],$userJson['nm_usuario'],$userJson['cd_email'],$userJson['nm_senha'],$userJson['dt_nascimento']);
                return 200;
            } else {
                return 400;
            }
        }

        function SetUser($id, $name, $email, $password, $birthday){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->birthday = $birthday;            
        }
    }
?>