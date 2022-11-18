<?php
     include "../../Services/Match/PassMatch.php";
     file_get_contents('php://input');

     $response = PassMatch(
          $_POST['rodada'] ?? null,
          $_POST['admin'] ?? null,
     );

     http_response_code($response->status);
     if($response->status != 204){
          echo json_encode($response->message);
     }
