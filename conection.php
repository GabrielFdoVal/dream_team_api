<?php

// $banco = 'db_dream_team';
// $host = 'localhost';
// $usuario = 'root';
// $senha = '';

// date_default_timezone_set('America/Sao_Paulo');


// try{
//     $pdo = new PDO("mysql:dbname=$banco;host=$host;charset=utf8","$usuario", "$senha");
// } catch (Exeption $e){
//     echo "Erro ao conectar com o banco de dados ".$e;
// }
$db = "db_dream_team"; //database name
$dbuser = "root"; //database username
$dbpassword = ""; //database password
$dbhost = "localhost";

$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $db);


?>