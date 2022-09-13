<?php
    function SelectAll($position) {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
            $res_player = $DB->Consult(
                "SELECT cd_jogador, nm_jogador, nm_posicao, qt_ponto, qt_rebote, qt_toco, qt_bola_recuperada, qt_assistencia, qt_arremesso_errado, qt_turn_over, cd_imagem, qt_preco, cd_time as codigo,
                (SELECT nm_time FROM tb_time WHERE cd_time = codigo) as time
                FROM tb_jogador AS j 
                WHERE nm_posicao 
                LIKE '%$position%';",
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