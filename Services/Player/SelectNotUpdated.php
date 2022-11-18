<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function SelectNotUpdatedPlayers($match): ResultService {
        $result = new ResultService();

        if($match == null){
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }
        
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Player/SelectNotUpdated.php");

        $code = SelectNotUpdated($match);

        if($code == 500){
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        } else {
            //echo json_encode($code);
            $result->Ok(200, $code);
        }

        return $result;
    }