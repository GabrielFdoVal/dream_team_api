<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function PassMatch(): ResultService {
        $result = new ResultService();

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Match/PassMatch.php");

        $code = Pass();

        if($code){
            $result->OkNoData(201);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }