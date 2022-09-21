<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/User.php");
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function SignUp($name, $email, $birthday, $leonita, $ametista, $password, $nickname, $point, $tatic, $sponsorsLeague): ResultService {
        $result = new ResultService();
        

        if($name == null || $email == null || $birthday == null || $leonita == null || $ametista == null || $password == null || $nickname == null || $point == null || $sponsorsLeague == null){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/User/Insert.php");

        $user = new User($name, $email, $birthday, $leonita, $ametista, $password, $nickname, $point, $tatic,$sponsorsLeague);
        $code = Insert($user);

        if($code){
            $result->Ok(201, $user->expose());
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }