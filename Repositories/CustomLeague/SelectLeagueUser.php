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
                "SELECT DISTINCT c.cd_liga_comum, c.nm_liga_comum, c.qt_rodada, c.qt_usuario, c.ic_privada, c.cd_privada, o.qt_pontos, c.vl_entrar, (SELECT u.nm_apelido
                FROM tb_usuario as u JOIN ordem_usuario_comum as o
                ON u.cd_usuario = o.cd_usuario
                AND o.ic_criador = 1 AND o.cd_liga_comum = c.cd_liga_comum) as nm_criador 
                FROM tb_liga_comum as c JOIN ordem_usuario_comum as o JOIN tb_usuario as u
                ON c.cd_liga_comum = o.cd_liga_comum
                AND o.cd_usuario = u.cd_usuario
                AND o.cd_usuario = $id;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_leagues){
            $leagues = array();
            for($i = 0; $i < sizeof($res_leagues); $i = $i + 9){
                $league = new CustomLeague($res_leagues[$i], $res_leagues[$i+1], $res_leagues[$i+2], $res_leagues[$i+3], $res_leagues[$i+4], $res_leagues[$i+5], $res_leagues[$i+6], $res_leagues[$i+7], $res_leagues[$i+8],"0");
                array_push($leagues, $league->expose());
            }
            return $leagues;
        } else {
            return false;
        }
    }