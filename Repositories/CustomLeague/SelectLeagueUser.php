<?php
    function SelectLeagueUser($email) {
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
                "SELECT c.cd_liga_comum, c.nm_liga_comum, c.qt_rodada, c.qt_usuario, c.ic_privada, c.cd_privada 
                FROM tb_liga_comum as c, ordem_usuario_comum as o 
                WHERE o.cd_usuario = $id;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_leagues){
            $leagues = array();
            for($i = 0; $i < sizeof($res_leagues); $i = $i + 6){
                $league = new CustomLeague($res_leagues[$i], $res_leagues[$i+1], $res_leagues[$i+2], $res_leagues[$i+3], $res_leagues[$i+4], $res_leagues[$i+5]);
                array_push($leagues, $league->expose());
            }
            return $leagues;
        } else {
            return false;
        }
    }