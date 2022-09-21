<?php
    function SelectTatic($email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        

        $DB = new DB();

        try {
            $res_tatic = $DB->Consult(
                "SELECT cd_tatica FROM tb_usuario WHERE cd_email = '$email';"
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_tatic){
            $tatic = array();
            array_push($tatic,$res_tatic[0]);
            return $tatic;
        }
        return 500;
    }