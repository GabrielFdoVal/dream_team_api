<?php

$db = "db_dream_team"; //database name
$dbuser = "root"; //database username
$dbpassword = ""; //database password
$dbhost = "localhost";

$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $db);

$return["error"] = true;
$return["result"] = "Error on parameters";

// $val = isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["birthday"]);

$val = true;

if($val){
    // $name = $_POST["name"];
    // $email = $_POST["email"];
    // $password = $_POST["password"];
    // $birthday = $_POST["birthday"];

    $name = "gabriel";
    $email = "gabriel@email";
    $password = "1234";
    $birthday = "2002-03-28";

    $dados = array();
    $sql = "SELECT * FROM tb_usuario";
    $res = $link->query("SELECT * FROM tb_usuario", MYSQLI_USE_RESULT);
    $dados = $res->fetch_object();
    if($res){
        $return["error"] = false;
        $return["result"] = $res;
        echo(json_encode($dados));
    }
    else{
        echo("bbbbbbbbbbbbbbbb");
    }
    

    // include_once("./conection.php");

    // $queryMaxCdUsuario = $pdo->query("select max(cd_usuario) from tb_usuario");
    // $resMaxCdUsuario = $queryMaxCdUsuario->fetchAll(PDO::FETCH_ASSOC);
    // $maxCdUsuario = json_encode($resMaxCdUsuario[0]['max(cd_usuario)']);
    // $newCdUsuario = $maxCdUsuario + 1;

    // $query = $pdo->query("insert into table tb_usuario values ($newCdUsuario, '$name', '$email', '$birthday', 0, 0, '$password', 'teste', 0, null)");
    // $res = $query->fetchAll(PDO::FETCH_ASSOC);

    // echo($res);
}
mysqli_close($link);

header('Content-Type: application/json');

echo json_encode($return);






































// $return["error"] = false;
// $return["result"] = "";


// $val = isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["birthday"]);

// $return["error"] = true;
// $return["result"] = "1";
// echo(json_encode($return));

// if($val) {
//     $return["error"] = true;
//     $return["result"] = "2";
//     echo(json_encode($return));

//     $name = $_POST["name"];
//     $email = $_POST["email"];
//     $password = $_POST["password"];
//     $birthday = $_POST["birthday"];

//     $return["error"] = true;
//     $return["result"] = "3";
//     echo(json_encode($return));

//     echo($name.$email.$password.$birthday);

//     include_once("./conection.php");

//     $queryMaxCdUsuario = $pdo->query("select max(cd_usuario) from tb_usuario");
//     $resMaxCdUsuario = $queryMaxCdUsuario->fetchAll(PDO::FETCH_ASSOC);
//     $maxCdUsuario = json_encode($resMaxCdUsuario[0]['max(cd_usuario)']);
//     $newCdUsuario = $maxCdUsuario + 1;
//     echo($newCdUsuario);

//     $return["error"] = true;
//     $return["result"] = "4";
//     echo(json_encode($return));

//     // $query = $pdo->query("insert into tb_usuario values ($newCdUsuario,'$name','$email',$birthday,0,0,'$password','',0,null)");
//     // $res = $query->fetchAll(PDO::FETCH_ASSOC);
//     // echo(json_encode($res));
// }
//     $return["error"] = true;
//     $return["result"] = "5";
//     header('Content-Type: application/json');
//     echo(json_encode($return));
?>

