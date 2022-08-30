<?php

$return["error"] = false;
$return["result"] = "";

$val = isset($_POST["email"]);

if($val){
    $email = $_POST["email"];


    include_once("./conection.php");

    $dados = array();
    $query = $pdo->query("select cd_email from tb_usuario where cd_email = '$email'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    if(json_encode($res) !== "[]"){
        $return["error"] = false;
        $return["result"] = true;
    }
    else {
        $return["error"] = false;
        $return["result"] = false;
    }
}

header('Content-Type: application/json');

echo json_encode($return);


?>