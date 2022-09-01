<?php
    include "../../Services/User/Insert.php";
    $Body = json_decode(file_get_contents('php://input'), true);

    $response = SignUp(
        $Body['Name'] ?? null,
        $Body['Email'] ?? null,
        $Body['Password'] ?? null,
        $Body['Birthday'] ?? null
    );

    http_response_code($response->Status);
    if($response->Status == 201){
        echo $response->Data;
    }
    else{
        echo json_encode($response->Message);
    }