<?php
    function SelectEmail($email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        

        $DB = new DB();

        try {
            $res_chekEmail = $DB->Consult(
                "SELECT * FROM tb_usuario WHERE cd_email = '$email';",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_chekEmail){
            return 201;
        } else {
            return 400;
        }
    }