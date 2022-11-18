<?php
    include "../../Services/Admin/SignIn.php";
    file_get_contents('php://input');

    $response = SignIn(
        $_POST['email'] ?? null,
        $_POST['password'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 200){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }