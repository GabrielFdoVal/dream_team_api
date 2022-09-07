<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/User.php");
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function ChangeNickname($email, $nickname): ResultService {
        $result = new ResultService();

        if($email == null || $nickname == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/UpdateNickname.php");

        $code = UpdateNickname($email, $nickname);

        if($code){
            $result->OkNoData(204);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }