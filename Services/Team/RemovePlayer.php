<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function RemovePlayer($player, $email): ResultService {
        $result = new ResultService();
        

        if($player == null || $email == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Team/DeletePlayer.php");

        $code = DeletePlayer($player, $email);

        if($code){
            $result->OkNoData(201);
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }