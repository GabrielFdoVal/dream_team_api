<?php
    include "../../Services/User/UpdateLeonitas.php";
    file_get_contents('php://input');

    $response = UpdateLeonitas(
        $_POST['email'] ?? null,
        $_POST['leonitas'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }