<?php

$return["error"] = true;
$return["result"] = "Error on parameters";

$val = isset($_POST["email"]);

if($val){
    $email = $_POST["email"];

    require('./conection.php');
    $sql = "SELECT cd_email FROM tb_usuario WHERE cd_email = '$email'";
    $res = $link->query($sql, MYSQLI_USE_RESULT);
    $found = json_encode($res->fetch_object());
    $link->close();
    
    if($found !== 'null'){
        $return["error"] = false;
        $return["result"] = true;
    }
    else {
        $return["error"] = false;
        $return["result"] = false;
    }
}
else{
    //erro nos parametros
}
header('Content-Type: application/json');

echo json_encode($return);


?>