<?php
    function UpdatePassword($email, $password): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_insert = $DB->ExecSQL(
                "
                    UPDATE TB_USUARIO
                    SET NM_SENHA = '$password'
                    WHERE CD_EMAIL = '$email'
                ;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_insert){
            return true;
        } else {
            return false;
        }
    }