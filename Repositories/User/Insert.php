<?php
    function Insert($user): bool {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");

        $DB = new DB();

        try {
            $res_getId = $DB->Consult(
                "SELECT max(cd_usuario) FROM tb_usuario;",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0] == null ? 1 : $res_getId[0] + 1;
            $res_insert = $DB->ExecSQL(
                "INSERT INTO tb_usuario VALUES 
                   ($id, 
                    '$user->name', 
                    '$user->email', 
                    '$user->birthday', 
                    $user->leonita, 
                    $user->ametista, 
                    '$user->password', 
                    '$user->nickname', 
                    $user->point,
                    $user->tatic,
                    $user->sponsorsLeague);",
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