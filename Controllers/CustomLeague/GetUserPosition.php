<?php
    include "../../Services/CustomLeague/GetUserPosition.php";
    file_get_contents('php://input');

    $response = GetUserPosition(
        $_GET['email'] ?? null,
        $_GET['league'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    } else {
        echo json_encode($response->data);
    }