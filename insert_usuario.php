<?php

$return["error"] = true;
$return["result"] = "Error on parameters";

$val = isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["birthday"]);

if($val){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birthday = $_POST["birthday"];
    
    require('./conection.php');
    $sql = "SELECT MAX(cd_usuario) FROM tb_usuario";
    $res = $link->query($sql, MYSQLI_USE_RESULT);
    
    if($res){
        $dados = json_encode($res->fetch_object());
        $json = json_decode($dados,true);
        $max = $json['MAX(cd_usuario)'] + 1;

        $link->close();
        require('./conection.php');

        $insert_sql = "INSERT INTO tb_usuario VALUES ($max, '$name', '$email', '$birthday', 0, 0, '$password', 'teste', 0, null);";
        $res_insert = $link->query($insert_sql, MYSQLI_USE_RESULT);
        $link->close();

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
else {

}
echo("Errro aqui o post está vazio");

header('Content-Type: application/json');

echo json_encode($return);
?>

