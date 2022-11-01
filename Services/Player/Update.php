<?php
    include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Services/ResultService.php");

    function UpdatePlayer($cd_jogador, $nm_jogador, $nm_posicao, $qt_ponto, $qt_rebote, $qt_toco, $qt_bola_recuperada, $qt_assistencia, $qt_arremesso_errado, $qt_turn_over, $cd_imagem, $qt_preco, $cd_time, $cd_admin, $cd_rodada): ResultService {
        $result = new ResultService();

        if($cd_jogador == null || $cd_admin == null){
            $result->Fail(400, "One or more fields are incorrect.");
            return $result;
        }
        
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Repositories/Player/Update.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");

        $player = new Player($cd_jogador, $nm_jogador, $nm_posicao, $qt_ponto, $qt_rebote, $qt_toco, $qt_bola_recuperada, $qt_assistencia, $qt_arremesso_errado, $qt_turn_over, $cd_imagem, $qt_preco, $cd_time);
        
        $code = Update($player, $cd_rodada, $cd_admin);

        if($code == 500){
            $result->Fail(500, json_encode("Internal Server Error. Please, try again later."));
        } else {
            $result->Ok($code, null);
        }

        return $result;
    }