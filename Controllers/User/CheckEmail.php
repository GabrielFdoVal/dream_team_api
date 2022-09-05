<?php
    include "../../Services/User/CheckEmail.php";
    file_get_contents('php://input');

    $response = CheckEmail(
        $_POST['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->message);
    }
    else{
        echo json_encode($response->message);
    }