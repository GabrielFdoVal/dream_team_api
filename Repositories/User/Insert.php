<?php
    function Insert($user): bool {
        include($_SERVER['DOCUMENT_ROOT']."/API/Connection.php");

        $DB = new DB();

        try {
            $res_insert = $DB->ExecSQL(
                "INSERT INTO tb_usuario VALUES 
                   ((SELECT Id FROM (select (max(cd_usuario) + 1) Id from tb_usuario) as Id), 
                    '$user->name', 
                    '$user->email', 
                    '$user->password', 
                    0, 
                    0, 
                    '$user->birthday', 
                    'teste', 
                    0, 
                    null);",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return false;
        }

        if($res_insert){
            return true;
        } else {
            return false;
        }
    }