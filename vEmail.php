<?php

$url = "https://192.168.15.7".$_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$email = $results['email'];

include_once("./conection.php");


$dados = array();
$query = $pdo->query("select * from tb_usuario where cd_email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for($i=0; $i < count($res); $i++){
    foreach($res[$i] as $key => $value){}
    $dados = $res;
}

echo($res) ?
json_encode(true):
json_encode(false);



?>