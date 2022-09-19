<?php
    function ChangeLeonitas($email, $leonitas): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_insert = $DB->ExecSQL(
                "
                    UPDATE TB_USUARIO
                    SET QT_LEONITA = '$leonitas'
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