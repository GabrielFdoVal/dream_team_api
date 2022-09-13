<?php
    include "../../Services/Player/Select.php";
    file_get_contents('php://input');

    $response = SelectPlayers(
        $_POST['position'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }