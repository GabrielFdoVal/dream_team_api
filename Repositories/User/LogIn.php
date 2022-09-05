<?php
    function LogIn($email, $password) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/User.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_logIn = $DB->Consult(
                "SELECT * FROM tb_usuario WHERE cd_email = '$email' AND nm_senha = '$password';",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }

        if($res_logIn){
            $userArray = array();
            $user = new User($res_logIn[1],$res_logIn[2],$res_logIn[3],$res_logIn[4],$res_logIn[5],$res_logIn[6],$res_logIn[7],$res_logIn[8],$res_logIn[9]);
            array_push($userArray, get_object_vars($user));
            return $userArray;
        } else {
            return false;
        }
    }