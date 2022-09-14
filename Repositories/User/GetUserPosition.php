<?php
    function SelectUserPosition($sponsorLeague, $nickname) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        

        $DB = new DB();

        try {
            $res_position = $DB->Consult(
                "SELECT nm_apelido FROM tb_usuario WHERE cd_liga_patrocinada = $sponsorLeague ORDER BY qt_pontos DESC;"
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_position){
            $p = array();
            $position = 1;
            for($i = 0; $i < sizeof($res_position); $i++){
                if($res_position[$i] === $nickname){
                    break;
                }
                $position++;
            }
            array_push($p,$position);
            return $p;
        }
        return 500;
    }