<?php
    function SelectPlayers($email) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
            $res_playerId = $DB->Consult(
                "SELECT cd_jogador FROM tb_compra_jogador WHERE cd_usuario = (SELECT cd_usuario FROM tb_usuario WHERE cd_email = '$email');",
                MYSQLI_USE_RESULT
            );
            $players = array(); 
            for($i = 0; $i < sizeof($res_playerId); $i++){
                $id = $res_playerId[$i];
                $res_player = $DB->Consult(
                    "SELECT cd_jogador, nm_jogador, nm_posicao, qt_ponto, qt_rebote, qt_toco, qt_bola_recuperada, qt_assistencia, qt_arremesso_errado, qt_turn_over, cd_imagem, qt_preco, cd_time as codigo,
                    (SELECT nm_time FROM tb_time WHERE cd_time = codigo) as time
                    FROM tb_jogador AS j 
                    WHERE cd_jogador = $id;",
                    MYSQLI_USE_RESULT
                );
                $player = new Player($res_player[0],$res_player[1],$res_player[2],$res_player[3],$res_player[4],$res_player[5],$res_player[6],$res_player[7],$res_player[8],$res_player[9],$res_player[10],$res_player[11],$res_player[13]);
                array_push($players, get_object_vars($player));
            }
        } catch (Exception $e) {
            return 500;
        }
        if($players){
            return $players;
        } else {
            return 500;
        }
    }