<?php
     include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

     function PassMatch($match, $admin): ResultService {
          $result = new ResultService();

          include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Match/PassMatch.php");

          if($match == null || $admin == null){
               //Validação dos campos aqui, caso algum esteja errado o erro é 400.
               $result->Fail(400, "One or more fields are incorrect.");
               return $result;
          }

          $code = Pass($match, $admin);

          if($code == 204){
               $result->OkNoData(204);
          }
          else if($code == 400){
               $result->Fail(400, "Partida já foi passada.");
          }
          else{
               $result->Fail(500, "Internal Server Error. Please, try again later.");
          }

          return $result;
     }