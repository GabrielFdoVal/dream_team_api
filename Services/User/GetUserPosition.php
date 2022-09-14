<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function GetUserPosition($sponsorLeague, $nickname): ResultService {
        $result = new ResultService();
        

        if($nickname == null or $sponsorLeague == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/GetUserPosition.php");

        $code = SelectUserPosition($sponsorLeague, $nickname);

        if($code != 500){
            $result->Ok(201, $code);
        }
        else {
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        }

        return $result;
    }