<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function GetPublicLeagues(): ResultService {
        $result = new ResultService();

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/CustomLeague/SelectPublicLeagues.php");

        $code = SelectPublicLeagues();

        if($code){
            $result->Ok(201, $code);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }