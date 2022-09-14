<?php
    include "../../Services/User/GetUserPosition.php";
    file_get_contents('php://input');

    $response = GetUserPosition(
        $_POST['sponsorLeague'] ?? null,
        $_POST['nickname'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }