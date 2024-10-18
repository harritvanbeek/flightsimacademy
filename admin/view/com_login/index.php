<?php 
    
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;

    $input      =   NEW \classes\core\input;
    $settings   =   NEW \classes\core\settings;
    $session    =   NEW \classes\core\session;
    $_config    =   NEW \classes\core\config;
    $login      =   NEW \classes\view\loginView;

    switch($action){
        case "userLogin":

            if($input->exist()){
                $email      =   !empty($input->get("data")["name"])     ? $input->get("data")["name"]       : NULL;
                $password   =   !empty($input->get("data")["password"]) ? $input->get("data")["password"]   : NULL;
                $remeber    =   !empty($input->get("data")["remeber"])  ? $input->get("data")["remeber"]    : NULL;
                    
                if(empty($email) === true)                           {$errors = ["Email is een verplichte veld"];}
                elseif($login->checkEmail($email) < 1)               {$errors = ["Ongeldige email format"];}                              
                elseif($login->emailExist($email) < 1)               {$errors = ["Opgegeven email is onjuist"];}
                
                elseif(empty($password) === true)                    {$errors = ["Wachtwoord is een verplichte veld"];}
                elseif($login->passwordExist($email, $password) < 1) {$errors = ["Opgegeven wachtwoord is onjuist"];} 

                if(!empty($input->exist()) and empty($errors)){
                    if(empty($remeber)){
                        $uuid = $login->logUserin($email);
                        if($uuid){
                            if( $session->put($_config->get("boann/user"), $uuid) ){
                                $dataArray =    [
                                    "data"          =>  "success",
                                    "reload"        =>  true,
                                ];                           
                            };                             
                        };
                    }
                }else{
                    $dataArray =    [
                        "data"          =>  "error",
                        "dataContent"   =>  "{$errors[0]}",                        
                    ];
                }
                    echo json_encode($dataArray);
            }
        break;
    }
