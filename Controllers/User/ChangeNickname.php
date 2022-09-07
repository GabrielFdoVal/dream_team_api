<?php
    include "../../Services/User/ChangeNickname.php";
    file_get_contents('php://input');

    $response = ChangeNickname(
        $_POST['email'] ?? null,
        $_POST['nickname'] ?? null
    );

    http_response_code($response->status);
    if($response->status != 204) {
        echo json_encode($response->message);
    }