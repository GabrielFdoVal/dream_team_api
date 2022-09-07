<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/User.php");
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function ChangeEmail($email, $newEmail): ResultService {
        $result = new ResultService();

        if($email == null || $newEmail == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/UpdateEmail.php");

        $code = UpdateEmail($email, $newEmail);

        if($code){
            $result->OkNoData(204);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }