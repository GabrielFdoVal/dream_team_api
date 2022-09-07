<?php
    include "../../Services/User/ChangeEmail.php";
    file_get_contents('php://input');

    $response = ChangeEmail(
        $_POST['email'] ?? null,
        $_POST['newEmail'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 204) {
        echo json_encode($response->message);
    }