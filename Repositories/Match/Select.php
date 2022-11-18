<?php
    function Select() {
          include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Match.php");
          include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
          
          $DB = new DB();

          try {
               $semana = $DB->Consult("select cd_rodada, dt_inicio, dt_fim	from tb_rodada where CURDATE() >= dt_inicio and CURDATE() <= dt_fim;");

               if($semana){
                    $matchArray = array();
                    $match = new MatchModel($semana[0], $semana[1], $semana[2]);
                    array_push($matchArray, get_object_vars($match));
                    return $matchArray;
               }
               else{
                    return 404;
               }

          } catch (Exception $e) {
               return 500;
          }
    }