<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function GetUser($email): ResultService {
        $result = new ResultService();
        

        if($email == null){
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/Selectuser.php");

        $code = SelectUser($email);

        if($code){
            $result->Ok(201, $code);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }