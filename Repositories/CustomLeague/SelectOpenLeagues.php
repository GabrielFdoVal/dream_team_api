<?php
    function SelectOpenLeagues($email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/CustomLeague.php");

        $DB = new DB();

        try {
            $res_getId = $DB->Consult(
                "SELECT max(cd_usuario) FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
            $id = $res_getId[0];
            $res_getUserLeague = $DB->Consult(
                "SELECT cd_liga_comum
                FROM ordem_usuario_comum
                WHERE cd_usuario = $id",
                MYSQLI_USE_RESULT
            );
            $res_leagues = $DB->Consult(
                "SELECT c.cd_liga_comum, c.nm_liga_comum, c.qt_rodada, c.qt_usuario, c.ic_privada, c.cd_privada, c.vl_entrar, u.nm_apelido,
                (SELECT COUNT(cd_usuario)
                FROM ordem_usuario_comum
                WHERE cd_liga_comum = c.cd_liga_comum) AS length
                FROM tb_usuario AS u JOIN ordem_usuario_comum AS o JOIN tb_liga_comum AS c
                ON u.cd_usuario = o.cd_usuario
                AND o.cd_liga_comum = c.cd_liga_comum
                AND o.ic_criador = 1
                AND c.ic_privada = 0;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }
        if($res_leagues){
            $leagues = array();
            $valid = true;
            for($i = 0; $i < sizeof($res_leagues); $i = $i + 9){
                for($j = 0; $j < sizeof($res_getUserLeague); $j = $j + 1){
                    if($res_leagues[$i] == $res_getUserLeague[$j]){
                        $valid = false;
                        break;
                    }
                }
                if($valid == true){               
                    $league = new CustomLeague($res_leagues[$i], $res_leagues[$i+1], $res_leagues[$i+2], $res_leagues[$i+3], $res_leagues[$i+4], $res_leagues[$i+5], "0", $res_leagues[$i+6], $res_leagues[$i+7], $res_leagues[$i+8], "0", "0");
                    array_push($leagues, $league->expose());
                } else {
                    $valid = true;
                }
                
            }
            return $leagues;
        } else {
            return false;
        }
    }