<?php
    function Pass() {
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Entities/Player.php");
        include($_SERVER['DOCUMENT_ROOT']."/dream_team_api/Connection.php");
        
        $DB = new DB();

        try {
          $DB->ExecSQL("update tb_liga_comum set qt_rodada = qt_rodada - 1;");

          $finishedLeagues = $DB->Consult("select cd_liga_comum from tb_liga_comum where qt_rodada = 0;");
          foreach($finishedLeagues as $Row){
               $DB->ExecSQL("call sp_paga_comum($Row);");
          }
          
          $pagarTimes = $DB->Consult("
               SELECT 
                    sum(((qt_ponto + qt_rebote + qt_toco + qt_bola_recuperada + qt_assistencia) - ( qt_arremesso_errado + qt_turnover)) * 10) as 'ganho',
                    sum((qt_ponto + qt_rebote + qt_toco + qt_bola_recuperada + qt_assistencia) - ( qt_arremesso_errado + qt_turnover)) as 'pontos',
                    compra.cd_usuario 
               FROM tb_jogador
                    join compra
               WHERE tb_jogador.cd_jogador = compra.cd_jogador
                    group by cd_usuario having count(cd_usuario) = 5;");

          foreach(array_chunk($pagarTimes, 3) as $Row=>$dado){
               $DB->ExecSQL("update tb_usuario set qt_leonitas = (qt_leonitas + $dado[0]) where cd_usuario = $dado[2];");
               $DB->ExecSQL("update ordem_usuario_comum set qt_pontos = (qt_pontos + $dado[1]) where cd_usuario = $dado[2];");
               $DB->ExecSQL("update ordem_usuario_patrocinada set qt_pontos = (qt_pontos + $dado[1]) where cd_usuario = $dado[2];");
          }
          
          $DB->ExecSQL("delete from tb_compra;");
        } catch (Exception $e) {
            return 500;
        }

        return 201;
    }