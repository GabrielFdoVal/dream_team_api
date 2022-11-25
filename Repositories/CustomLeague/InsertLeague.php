<?php
    function InsertLeague($name, $rounds, $userLength, $private, $value, $email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/CustomLeague.php");

        $DB = new DB();

        try {
            $code = str_pad(strval(random_int(0, 99999999)), 8, '0');

            $res_getId = $DB->Consult(
                "SELECT max(cd_liga_comum) FROM tb_liga_comum;",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0] == null ? 1 : $res_getId[0] + 1;

            $res_getUserId = $DB->Consult(
                "SELECT cd_usuario FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $userId = $res_getUserId[0];

            $res_getUserNickName = $DB->Consult(
                "SELECT nm_apelido FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $userNickname = $res_getUserNickName[0];

            $res_insert = $DB->ExecSQL(
                "INSERT INTO tb_liga_comum VALUES 
                   ($id, 
                    '$name', 
                    $rounds, 
                    $userLength,
                    $private,
                    $code,
                    $value);",
                MYSQLI_USE_RESULT
            );

            $res_insertUser = $DB->ExecSQL(
                "INSERT INTO ordem_usuario_comum VALUES 
                   ($userId, 
                    $id, 
                    0, 
                    1);",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_insert){
            $leauge = new CustomLeague($id, $name, $rounds, $userLength, $private, $code, "0", $value, $userNickname, "1", "1");
            return $leauge->expose();
        } else {
            return false;
        }
    }