<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function GetOpenLeagues($email): ResultService {
        $result = new ResultService();

        if($email == null){
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/CustomLeague/SelectOpenLeagues.php");

        $code = SelectOpenLeagues($email);

        if($code){
            $result->Ok(201, $code);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }