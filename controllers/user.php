<?php
    require("../services/user.php");
    switch($_SERVER['REQUEST_METHOD']){
        case "POST":
            $user = new User();
            if(!isset($_POST['name']) && !isset($_POST['birthday'])){
                $response = $user->SignIn(
                    $_POST['email'],
                    $_POST['password'],
                );
                http_response_code($response);
                if($response == 200){
                    echo json_encode($user);
                }
            } else {
                $response = $user->SignUp(
                    $_POST['name'],
                    $_POST['email'],
                    $_POST['password'],
                    $_POST['birthday']
                );
                http_response_code($response);
                if($response == 200){
                    echo json_encode($user);
                }
            }
            break;
        case "GET":
            
            $user = new User();
            $response = $user->validateEmail($_GET['email']);
            http_response_code($response);
            if($response == 200){
                 echo json_encode($user);
            }
            break;
    }