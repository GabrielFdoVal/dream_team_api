<?php
    include "../../Services/User/ChangePassword.php";
    file_get_contents('php://input');

    $response = ChangePassword(
        $_POST['email'] ?? null,
        $_POST['password'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 204) {
        echo json_encode($response->message);
    }