<?php
    include "../../Services/CustomLeague/AddUser.php";
    file_get_contents('php://input');

    $response = AddUser(
        $_POST['email'] ?? null,
        $_POST['leagueId'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 201) {
        echo json_encode($response->message);
    }