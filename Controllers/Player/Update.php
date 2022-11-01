<?php
    include "../../Services/Player/Update.php";
    file_get_contents('php://input');

    $response = UpdatePlayer(
        $_POST['cd_jogador'] ?? null,
        $_POST['nm_jogador'] ?? null,
        $_POST['nm_posicao'] ?? null,
        $_POST['qt_ponto'] ?? null,
        $_POST['qt_rebote'] ?? null,
        $_POST['qt_toco'] ?? null,
        $_POST['qt_bola_recuperada'] ?? null,
        $_POST['qt_assistencia'] ?? null,
        $_POST['qt_arremesso_errado'] ?? null,
        $_POST['qt_turn_over'] ?? null,
        $_POST['cd_imagem'] ?? null,
        $_POST['qt_preco'] ?? null,
        $_POST['cd_time'] ?? null,
        $_POST['cd_admin'] ?? null,
        $_POST['cd_rodada'] ?? null,
    );

    http_response_code($response->status);
    if($response->status != 204){
        echo json_encode($response->message);
    }