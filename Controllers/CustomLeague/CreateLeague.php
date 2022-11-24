<?php
    include "../../Services/CustomLeague/CreateLeague.php";
    file_get_contents('php://input');

    $response = CreateLeague(
        $_POST['name'] ?? null,
        $_POST['rounds'] ?? null,
        $_POST['userLength'] ?? null,
        $_POST['private'] ?? null,
        $_POST['value'] ?? null,
        $_POST['email'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    } else {
        echo json_encode($response->data);
    }