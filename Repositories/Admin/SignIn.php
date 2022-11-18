<?php
    function LogIn($email, $password) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Admin.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_logIn = $DB->Consult(
                "SELECT * FROM tb_admin WHERE cd_email = '$email' AND nm_senha = '$password';",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }

        if($res_logIn){
            $userArray = array();
            $user = new Admin($res_logIn[0], $res_logIn[1],$res_logIn[2],$res_logIn[3],$res_logIn[4]);
            array_push($userArray, get_object_vars($user));
            return $userArray;
        } else {
            return false;
        }
    }