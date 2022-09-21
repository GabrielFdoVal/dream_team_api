<?php
    include "../../Services/User/Insert.php";
    file_get_contents('php://input');

    $response = SignUp(
        $_POST['name'] ?? null,
        $_POST['email'] ?? null,        
        $_POST['birthday'] ?? null,
        $_POST['leonita'] ?? null,
        $_POST['ametista'] ?? null,
        $_POST['password'] ?? null,
        $_POST['nickname'] ?? null,
        $_POST['point'] ?? null,
        $_POST['tatic'] ?? null,
        $_POST['sponsorsLeague'] ?? null,
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }