<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function SelectSponsorsLeague(): ResultService {
        $result = new ResultService();
        
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/SponsorsLeague/Select.php");

        $code = SelectAll();

        if($code == 500){
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        } else {
            //echo json_encode($code);
            $result->Ok(201, $code);
        }

        return $result;
    }