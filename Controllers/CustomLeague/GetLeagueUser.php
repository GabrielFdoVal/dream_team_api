<?php
    include "../../Services/CustomLeague/GetLeagueUser.php";
    file_get_contents('php://input');

    $response = GetLeagueUser(
        $_GET['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    } else {
        echo json_encode($response->data);
    }