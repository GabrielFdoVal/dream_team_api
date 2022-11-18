<?php
    function SelectLeagueMembers($customLeague) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/LeagueMembers.php");
        

        $DB = new DB();

        try {
            $res_member = $DB->Consult(
                "SELECT u.nm_apelido, o.qt_pontos
                FROM tb_usuario as u JOIN ordem_usuario_comum as o
                ON u.cd_usuario = o.cd_usuario
                AND o.cd_liga_comum = $customLeague
                ORDER BY o.qt_pontos DESC;"
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_member){
            $members = array();
            $position = 1;
            for($i = 0; $i < sizeof($res_member); $i = $i + 2){
                $member = new LeagueMember($res_member[$i], $res_member[$i+1], $position);
                $position++;
                array_push($members,$member);
            }
            return $members;
        }
        return 500;
    }