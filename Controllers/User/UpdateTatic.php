<?php
    include "../../Services/User/UpdateTatic.php";
    file_get_contents('php://input');

    $response = UpdateTatic(
        $_POST['email'] ?? null,
        $_POST['tatic'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }