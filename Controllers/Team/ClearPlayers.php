<?php
    include "../../Services/Team/ClearPlayers.php";
    file_get_contents('php://input');

    $response = ClearPlayers(
        $_POST['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }