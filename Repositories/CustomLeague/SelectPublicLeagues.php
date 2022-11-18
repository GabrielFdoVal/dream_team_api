<?php
    function SelectPublicLeagues() {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/PublicLeagues.php");

        $DB = new DB();

        try {
            $res_leagues = $DB->Consult(
                "SELECT c.cd_liga_comum, c.nm_liga_comum, u.nm_apelido,
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
            for($i = 0; $i < sizeof($res_leagues); $i = $i + 4){
                $league = new PublicLeagues($res_leagues[$i], $res_leagues[$i+1], $res_leagues[$i+2], $res_leagues[$i+3]);
                array_push($leagues, $league->expose());
            }
            return $leagues;
        } else {
            return false;
        }
    }