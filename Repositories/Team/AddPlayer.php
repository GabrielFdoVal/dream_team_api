<?php
    function InsertPlayer($player, $email, $datetime): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_getId = $DB->Consult(
                "SELECT max(cd_compra) FROM tb_compra_jogador;",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0] == null ? 1 : $res_getId[0] + 1;
            $res_getUserId = $DB->Consult(
                "SELECT cd_usuario FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $userId = $res_getUserId[0];
            $res_insert = $DB->ExecSQL(
                "INSERT INTO tb_compra_jogador VALUES 
                   ($id, 
                    $userId, 
                    $player, 
                    '$datetime');",
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