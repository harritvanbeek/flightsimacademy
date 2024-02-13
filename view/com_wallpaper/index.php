<?php
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';
    
    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;

    $input      =   NEW \classes\core\input;

    switch($action){
        case "saveImages" :
            $pilotID    =   !empty($input->get("data")["pilotID"]) ? $input->get("data")["pilotID"] : NULL;
            if($pilotID){
                $data       = file_get_contents("https://vamsys.io/statistics/map/0ce3546d-758f-4d07-a883-6d4daf4c925a");
                if(!empty($data)){
                    $jsonData   = json_decode($data, true);
                    foreach($jsonData as $flight){
                        if($flight["pilot"]["username"] === $pilotID){
                            $regCode    =   strtolower($flight["aircraft"]["registration"]);
                            $oldFile = "../../assets/uploads/{$_SESSION["imgName"]}";
                            $newFile = "../../assets/uploads/{$regCode}.jpg";
                            $newLocation = "../../assets/wallpapers/{$regCode}.jpg";
                            
                            if(getimagesize($oldFile)[0] > 1920 and getimagesize($oldFile)[1] > 1080){
                                $dataArray  =   [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "The images is too large it neet to be '1920' by '1080' ",
                                ];
                                
                                unlink($oldFile);

                            }elseif(getimagesize($oldFile)[0] < 1920 and getimagesize($oldFile)[1] < 1080){
                                $dataArray  =   [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "The images is too small it neet to be '1920' by '1080' ",
                                ];
                                
                                unlink($oldFile);

                            }elseif(getimagesize($oldFile)[0] === 1920 and getimagesize($oldFile)[1] === 1080){
                                
                                if(file_exists($newLocation)){
                                    $dataArray  =   [
                                            "data"          =>  "error",
                                            "dataContent"   =>  "This file is all ready exist",
                                    ];
                                }else{
                                    rename($oldFile, $newFile);
                                    copy($newFile, $newLocation);
                                    if(unlink($newFile)){
                                        $dataArray  =   [
                                            "data"          =>  "success",
                                            "dataContent"   =>  "Thank you for sharing withe us",
                                        ];
                                    };                                    
                                }

                            }
                        }
                    }
                }else{
                    $dataArray  =   [
                        "data"          =>  "error",
                        "dataContent"   =>  "We have no information.",
                    ];
                }

                    echo json_encode($dataArray);
            }
        break;

        case "DeleteUploaded" :
            if($_SESSION["imgName"]){
                $file = "../../assets/uploads/{$_SESSION["imgName"]}";
                if(file_exists($file)){
                    $fileExist = dirname(dirname(dirname(__file__))).DS."assets".DS."uploads".DS."{$_SESSION["imgName"]}"; 
                    if(unlink($fileExist)){
                        $dataArray  =   [                        
                            "data"           =>  "success",
                            "dataContent"    =>  ""
                        ];
                        echo json_encode($dataArray);
                    };                    
                } 
            };
        break;

        case "uploadImages" :
            if(!empty($_FILES['file'])){
                $uploadDir  =   "../../assets/uploads/{$_FILES['file']['name']}"; 
                if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir)){
                    $_SESSION["imgName"]    =   $_FILES['file']['name'];
                    $dataArray  =   [                        
                        "img"       =>  "./assets/uploads/{$_FILES['file']['name']}"
                    ];
                    echo json_encode($dataArray);
                };



            }
        break;

        case "wallpaper" :
            $dir    = dirname(dirname(dirname(__file__))).DS."assets".DS."wallpapers";
            foreach(scandir($dir) as $item){
                if(".." !== $item and "." !== $item and "no_images.jpg" !== $item){

                    $imgData = exif_read_data($dir.DS.$item);
                    $title   = explode(".", $imgData["FileName"])[0];
                    $date    = date("d-m-Y", $imgData["FileDateTime"]);
                    $images  = "./assets".DS."wallpapers".DS.$item;

                    $dataArray[]    =   [
                        "scr"       => "{$images}",
                        "title"     => "{$title}",
                        "date"      => "{$date}",
                    ];
                }
            }
                echo json_encode($dataArray);
        break;
    }
