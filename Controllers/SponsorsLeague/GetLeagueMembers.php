<?php
    include "../../Services/SponsorsLeague/GetLeagueMembers.php";
    file_get_contents('php://input');

    $response = GetLeagueMembers(
        $_POST['sponsorLeague'] ?? null
    );

    http_response_code($response->status);
    if($response->status == 201){
        echo json_encode($response->data);
    }
    else{
        echo json_encode($response->message);
    }