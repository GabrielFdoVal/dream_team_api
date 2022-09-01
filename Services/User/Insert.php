<?php
    include($_SERVER['DOCUMENT_ROOT']."/API/Entities/User.php");
    include($_SERVER['DOCUMENT_ROOT']."/API/Services/ResultService.php");

    function SignUp($Name, $Email, $Password, $Birthday): ResultService {
        $result = new ResultService();

        if($Name == null || $Email == null || $Password == null || $Birthday == null ){
            //Validação dos campos aqui, caso algum esteja errado o erro é 400.
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }

        include($_SERVER['DOCUMENT_ROOT']."/API/Repositories/User/Insert.php");

        $user = new User($Name, $Email, $Password, $Birthday);
        $code = Insert($user);

        if($code){
            $result->Ok(201, json_encode($user->expose()));
        }
        else{
            $result->Fail(500, "Internal Server Error. Please, try again later.");
        }

        return $result;
    }