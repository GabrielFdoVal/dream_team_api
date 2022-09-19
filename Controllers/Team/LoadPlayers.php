<?php
    include "../../Services/Team/LoadPlayers.php";
    file_get_contents('php://input');

    $response = LoadPlayers(
        $_POST['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }