<?php

$return["error"] = true;
$return["result"] = "Error on parameters";

$val = isset($_POST["email"]) && isset($_POST["password"]);

if($val){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    require("./conection.php");
    $sql = "SELECT cd_email, nm_senha FROM tb_usuario WHERE cd_email = '$email'";
    $res = $link->query($sql, MYSQLI_USE_RESULT);
    $user = json_encode($res->fetch_object());
    $link->close();

    if($user !== 'null'){
        echo("Cadastrado");
        $userJson = json_decode($user, true);
        if($userJson['nm_senha'] !== $password){
            echo("Senha incorreta");
        } else {
            echo("Logado com sucesso");
        }
    }
    else {
        echo("Não cadastrado");
    }
    
}


header('Content-Type: application/json');

echo json_encode($return);
?>

