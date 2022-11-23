<?php
    function SelectUserPosition($email, $league) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/CustomLeague.php");

        $DB = new DB();

        try {
            $res_getId = $DB->Consult(
                "SELECT max(cd_usuario) FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0];
            $res_leagues = $DB->Consult(
                "SELECT cd_usuario, qt_pontos 
                FROM ordem_usuario_comum 
                WHERE cd_liga_comum = $league
                ORDER BY qt_pontos DESC;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_leagues){
            $p = array();
            $position = 1;
            for($i = 0; $i < sizeof($res_leagues); $i = $i + 2){
                if($res_leagues[$i] == $id){
                    array_push($p, $position);
                    return $p;
                }
                $position++;
            }
            return false;
        } else {
            return false;
        }
    }