<?php
    function SelectUser($email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/User.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $resGetUser = $DB->Consult(
                "SELECT * FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }

        if($resGetUser){
            $userArray = array();
            $user = new User($resGetUser[1],$resGetUser[2],$resGetUser[3],$resGetUser[4],$resGetUser[5],$resGetUser[6],$resGetUser[7],$resGetUser[8],$resGetUser[9],$resGetUser[10]);
            array_push($userArray, get_object_vars($user));
            return $userArray;
        } else {
            return false;
        }
    }