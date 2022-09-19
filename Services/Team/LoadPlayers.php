<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function LoadPlayers($email): ResultService {
        $result = new ResultService();

        if($email == null){
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }
        
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Team/LoadPlayers.php");

        $code = SelectPlayers($email);

        if($code == 500){
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        } else {
            //echo json_encode($code);
            $result->Ok(201, $code);
        }

        return $result;
    }