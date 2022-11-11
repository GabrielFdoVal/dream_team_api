<?php
    function Select() {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
          $semana = $DB->Consult("select cd_semana from tb_semana where CURDATE() >= dt_inicio and CURDATE() <= dt_fim;");

          if($semana){
               return $semana[0];
          }
        } catch (Exception $e) {
            return 500;
        }
    }