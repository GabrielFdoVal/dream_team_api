<?php
    include "../../Services/Match/SelectMatch.php";
    file_get_contents('php://input');

    $response = SelectMatch();

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }