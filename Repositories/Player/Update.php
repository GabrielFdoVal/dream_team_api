<?php
     function Update(Player $player, $cd_rodada, $cd_admin) {
          // include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");
          include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
          
          $DB = new DB();

          try {
               $res_player = $DB->Consult(
                    "SELECT *
                    FROM tb_jogador
                    WHERE cd_jogador = $player->id;",
                    MYSQLI_USE_RESULT
               );
          } catch (Exception $e) {
               return 500;
          }
          
          try {
               if($cd_rodada == NULL) {$cd_rodada = "NULL";}
               $updt = $DB->ExecSQL(
               "INSERT INTO log_tb_jogador VALUES ($res_player[0], '$res_player[1]', '$res_player[2]', $res_player[3], $res_player[4], $res_player[5], $res_player[6], $res_player[7], $res_player[8], $res_player[9], '$res_player[10]', $res_player[11], $res_player[12], $cd_rodada, $cd_admin, now())",
               MYSQLI_USE_RESULT
               );
          } catch (Exception $e) {
               return 500;
          }
          
          if(sizeof($res_player) > 0){
               $player->id = $player->id ?? $res_player[0];
               $player->name = $player->name ?? $res_player[1];
               $player->position = $player->position ?? $res_player[2];
               $player->point = $player->point ?? $res_player[3];
               $player->rebound = $player->rebound ?? $res_player[4];
               $player->block  = $player->block ?? $res_player[5];
               $player->steal = $player->steal ?? $res_player[6];
               $player->assist = $player->assist ?? $res_player[7];
               $player->missShot = $player->missShot ?? $res_player[8];
               $player->turnOver = $player->turnOver ?? $res_player[9];
               $player->imgUrl = $player->imgUrl ?? $res_player[10];
               $player->price = $player->price ?? $res_player[11];
               $player->team = $player->team ?? $res_player[12];
               
               $points = ($player->point + $player->rebound + $player->steal + $player->assist) - ($player->missShot + $player->turnOver);
               
               try {
                    $rplc = $DB->ExecSQL(
                    "REPLACE INTO tb_jogador VALUES ($player->id, '$player->name', '$player->position', $player->point, $player->rebound, $player->block, $player->steal, $player->assist, $player->missShot, $player->turnOver, '$player->imgUrl', $points * 5, $player->team);",
                    MYSQLI_USE_RESULT
                    );

                    if($rplc){
                         return 204;
                    }

               } catch (Exception $e) {
                    return 500;
               }
          } else {
               return 404;
          }
     }