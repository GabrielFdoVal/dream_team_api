<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function RemoveUser($email, $leagueId): ResultService {
        $result = new ResultService();
        

        if($email == null || $leagueId == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/CustomLeague/DeleteUser.php");

        $code = DeleteUser($email, $leagueId);

        if($code){
            $result->OkNoData(201);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }