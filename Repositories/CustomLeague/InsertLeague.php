<?php
    function InsertLeague($name, $rounds, $userLength, $private) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/CustomLeague.php");

        $DB = new DB();

        try {
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
                    $private);",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_insert){
            $leauge = new CustomLeague($id, $name, $rounds, $userLength, $private);
            return $leauge->expose();
        } else {
            return false;
        }
    }