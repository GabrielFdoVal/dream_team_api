<?php
    include "../../Services/CustomLeague/GetPublicLeagues.php";
    file_get_contents('php://input');

    $response = GetPublicLeagues();

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    } else {
        echo json_encode($response->data);
    }