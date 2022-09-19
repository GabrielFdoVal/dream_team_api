<?php
    function DeleteAllPlayers($email): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_id = $DB->Consult(
                "SELECT cd_usuario FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $id = $res_id[0];
            $res_insert = $DB->ExecSQL(
                "
                    DELETE FROM tb_compra_jogador WHERE cd_usuario = $id
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