<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function CreateLeague($name, $rounds, $userLength, $private, $value, $email): ResultService {
        $result = new ResultService();
        

        if($name == null || $rounds == null || $userLength == null || $private == null || $value == null || $email == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/CustomLeague/InsertLeague.php");

        $code = InsertLeague($name, $rounds, $userLength, $private, $value, $email);

        if($code){
            $result->Ok(201, $code);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }