<?php
    function SelectAll() {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/SponsorsLeague.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
            $res_league = $DB->Consult(
                "SELECT * FROM tb_liga_patrocinada;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_league){
            $leagues = array();
            for($i = 0; $i < sizeof($res_league); $i = $i + 2){
                $league = new SponsorLeague($res_league[$i],$res_league[$i+1]);
                array_push($leagues, get_object_vars($league));
            }
            
            return $leagues;
        } else {
            return 500;
        }
    }