<?php
    function UpdateNickname($email, $nickname): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $resUpdateNick = $DB->ExecSQL(
                "UPDATE TB_USUARIO SET NM_APELIDO = '$nickname' WHERE CD_EMAIL = '$email';"
            );
            $resSelectLeonitas = $DB->Consult("SELECT QT_LEONITA FROM TB_USUARIO WHERE CD_EMAIL = '$email';");
            $leonitas = $resSelectLeonitas[0] == null ? 1 : $resSelectLeonitas[0] - 100;
            $res_insert = $DB->ExecSQL(
                "
                    UPDATE TB_USUARIO
                    SET QT_LEONITA = $leonitas
                    WHERE CD_EMAIL = '{$email}'
                ;"
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