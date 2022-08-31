<?php

$db = "db_dream_team"; //database name
$dbuser = "root"; //database username
$dbpassword = ""; //database password
$dbhost = "localhost";

$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $db);

$return["error"] = true;
$return["result"] = "Error on parameters";

$val = isset($_POST["email"]) && isset($_POST["password"]);

$val = true;

if($val){
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT cd_usuario FROM tb_usuario WHERE cd_email = '$email' AND nm_senha = '$password'";
    $res = $link->query($sql, MYSQLI_USE_RESULT);
    
    if($res){
        $dados = json_encode($res->fetch_object());
        $json = json_decode($dados,true);
        $max = $json['MAX(cd_usuario)'] + 1;

        if($res_insert){
            $return["error"] = false;
            $return["result"] = "insert sucsseful";
        } else {
            $return["error"] = true;
            $return["result"] = "Failed on insert into tb_usuario";
        }
        
    }
    else{
        $return["error"] = true;
        $return["result"] = "Failed on get the max id";
    }
}
mysqli_close($link);

header('Content-Type: application/json');

echo json_encode($return);
?>

