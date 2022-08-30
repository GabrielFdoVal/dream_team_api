<?php

// $url = "https://192.168.15.7".$_SERVER['REQUEST_URI'];
// $components = parse_url($url);
// parse_str($components['query'], $results);
// $name = $results['name'];
// $email = $results['email'];
// $password = $results['password'];
// $birthday = $results['birthday'];

// $name = $_POST['name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $birthday = $_POST['birthday'];

$name = "Gabriel";
$email = "gabriel@email.com";
$password = "123";
$birthday = "2002-03-28";

include_once("./conection.php");

$queryMaxCdUsuario = $pdo->query("select max(cd_usuario) from tb_usuario");
$resMaxCdUsuario = $queryMaxCdUsuario->fetchAll(PDO::FETCH_ASSOC);
$maxCdUsuario = json_encode($resMaxCdUsuario[0]['max(cd_usuario)']);
$newCdUsuario = $maxCdUsuario + 1;
echo($newCdUsuario);


$queryInsertUsuario = $pdo->query("insert into tb_usuario values $newCdUsuario, '$name', '$email', '$birthday', 0, 0, '$password', 'teste', 0, null");
// $resInsertUsuario = $queryInsertUsuario->fetchAll(PDO::FETCH_ASSOC);
// echo(json_encode($resInsertUsuario));


// echo($res) ?
// json_encode(true):
// json_encode(false);



?>