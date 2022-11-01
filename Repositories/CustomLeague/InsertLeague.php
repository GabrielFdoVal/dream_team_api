<?php
    function InsertLeague($name, $rounds, $userLength, $private) {
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
            $res_insert = $DB->ExecSQL(
                "INSERT INTO tb_liga_comum VALUES 
                   ($id, 
                    '$name', 
                    $rounds, 
                    $userLength,
                    $private,
                    $code);",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_insert){
            $leauge = new CustomLeague($id, $name, $rounds, $userLength, $private, $code);
            return $leauge->expose();
        } else {
            return false;
        }
    }