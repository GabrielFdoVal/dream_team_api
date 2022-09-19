<?php
    include "../../Services/Team/AddPlayer.php";
    file_get_contents('php://input');

    $response = AddPlayer(
        $_POST['player'] ?? null,
        $_POST['email'] ?? null,
        $_POST['datetime'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }