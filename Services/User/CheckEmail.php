<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function CheckEmail($email): ResultService {
        $result = new ResultService();
        

        if($email == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/CheckEmail.php");

        $code = SelectEmail($email);

        if($code == 201){
            $result->OkNoData(201, json_encode("Email already signed up"));
        }
        else if($code == 400){
            $result->Fail(400, json_encode("Email not found"));
        }
        else if($code == 500){
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        }

        return $result;
    }