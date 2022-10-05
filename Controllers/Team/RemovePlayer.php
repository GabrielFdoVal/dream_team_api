<?php
    include "../../Services/Team/RemovePlayer.php";
    file_get_contents('php://input');

    $response = RemovePlayer(
        $_POST['player'] ?? null,
        $_POST['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }