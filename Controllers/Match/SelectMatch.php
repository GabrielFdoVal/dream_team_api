<?php
    include "../../Services/Match/SelectMatch.php";
    file_get_contents('php://input');

    $response = SelectMatch();

    http_response_code($response->status);
    if($response->status == 200){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }