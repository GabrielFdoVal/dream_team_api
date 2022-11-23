<?php
    function DeleteUser($email, $leagueId):bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_getId = $DB->Consult(
                "SELECT max(cd_usuario) FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0];
            $res_insert = $DB->ExecSQL(
                "DELETE FROM ordem_usuario_comum 
                WHERE cd_usuario = $id 
                AND cd_liga_comum = $leagueId;",
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