<?php
    function SelectNotUpdated($match) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
            $res_player = $DB->Consult(
               "select distinct
                    tb_jogador.cd_jogador as 'CODIGO',
                    tb_time.cd_time as 'CODIGO TIME',
                    tb_semana.cd_semana as 'SEMANA'
               from tb_jogador
                    join tb_time
                    join tb_partida
                    join tb_semana
                         on tb_jogador.cd_time = tb_time.cd_time
                         or tb_time.cd_time = tb_partida.cd_time_casa
                         and tb_time.cd_time = tb_partida.cd_time_visitante
                         and tb_partida.cd_semana = tb_semana.cd_semana
               where tb_semana.cd_semana = ".$match."
                    and NOT EXISTS (select cd_jogador from log_tb_jogador where cd_jogador = tb_jogador.cd_jogador and cd_rodada = ".$match.";
               order by tb_jogador.cd_jogador;",
                MYSQLI_USE_RESULT
            );
        } catch (Exception $e) {
            return 500;
        }
        if($res_player){
            $players = array(); 
            for($i = 0; $i < sizeof($res_player); $i = $i + 14){
                $player = new Player($res_player[$i],$res_player[$i+1],$res_player[$i+2],$res_player[$i+3],$res_player[$i+4],$res_player[$i+5],$res_player[$i+6],$res_player[$i+7],$res_player[$i+8],$res_player[$i+9],$res_player[$i+10],$res_player[$i+11],$res_player[$i+13]);
                array_push($players, get_object_vars($player));
            }
            return $players;
        } else {
            return 500;
        }
    }