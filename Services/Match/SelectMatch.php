<?php
     include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

     function SelectMatch(): ResultService {
          $result = new ResultService();
          
          include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Match/Select.php");
          
          $code = Select();
          
          if($code == 500){
               $result->Fail($code, json_encode("Internal Server Error. Please, try again later."));
          } else if ($code == 404){
               $result->Fail($code, json_encode("Nothing found."));
          }
          else{
               $result->Ok(200, $code);
          }

          return $result;
     }