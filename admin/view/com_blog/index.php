<?php 
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';

    $_POST      =   json_decode(file_get_contents("php://input"), true)["0"];

    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $input      =   NEW \classes\core\input;
    $session    =   NEW \classes\core\session;
    $setting    =   NEW \classes\core\settings;
    $_config    =   NEW \classes\core\config;

    $blog       =   NEW \classes\view\blogView;
    //Fivem
    //debug($action);
    switch($action){
        //begin Blog Content
            case "getBlog" :
                foreach($blog->getContent() as $item){
                    $dataArray[] =    [
                        "uuid"      => "{$item->uuid}",
                        "title"     => "{$item->title}",
                        "alias"     => "{$item->alias}",
                        "post_data" => date("l d, Y h:i", $item->post_date),
                    ];
                }                       
                    echo json_encode($dataArray);
            break;

            case "postBlog" :
                if($input->exist()){
                   $title       = !empty($input->get("data")["title"])      ? escape($input->get("data")["title"])      : NULL;  
                   $alias       = $setting->alias($title);  
                   $uuidCat     = !empty($input->get("data")["catogory"])   ? $input->get("data")["catogory"]           : NULL;
                   $uuidTag     = !empty($input->get("data")["tags"])       ? $input->get("data")["tags"]               : NULL;
                   $content     = !empty($input->get("data")["bericht"])    ? $input->get("data")["bericht"]            : NULL;
                
                   if(!empty($input->exist()) and empty($errors)){ 
                        $postArray =    [
                            "uuid"      => "{$setting->MakeUuid()}",
                            "title"     => "{$title}",
                            "alias"     => "{$alias}",
                            "uuidCat"   => "{$uuidCat}",
                            "uuidTag"   => "{$uuidTag}",
                            "content"   => "{$content}",
                            "post_data" =>  date("Y-m-d h:i:s", getdate()[0]),
                        ];
                        
                        if($blog->postContent($postArray) > 0){
                            $dataArray =    [
                                "data"          =>  "success",
                                "dataContent"   =>  "systeem is bijgwerekt",
                            ];  
                        }else{
                            //errors
                            $dataArray =    [
                                "data"          =>  "error",
                                "dataContent"   =>  "Er is een fout op getreden met de database.",
                            ];  
                        }
                   }else{
                            //errors
                            $dataArray =    [
                                "data"          =>  "error",
                                "dataContent"   =>  "{$errors[0]}",
                            ]; 
                   }
                        echo json_encode($dataArray);
                }                   
            break;

            case "removeBlog" :
                if($input->exist()){
                    $uuid = !empty($input->get("data")["uuid"]) ? escape($input->get("data")["uuid"]) : null;
                    
                    if( $blog->removeBlog($uuid) > 0){
                        $dataArray =    [
                            "data"          =>  "success",
                            "dataContent"   =>  "systeem is bijgwerekt",
                        ];  
                    }else{
                        //errors
                        $dataArray =    [
                            "data"          =>  "error",
                            "dataContent"   =>  "Er is een fout op getreden met de database.",
                        ];  
                    };

                    echo json_encode($dataArray);
                }
            break;
        //End Blog Content
        //
        //begin catogorys
            case "deleteCatogory" :
                //chek is empty
            break;

            case "getCatogory" :  
                foreach($blog->getCatogory() as $item){
                    $dataArray[] = [
                        "uuid"      => "{$item->uuid}",
                        "catogory"  => "{$item->name}",
                        "alias"     => "{$item->alias}",
                        "date"      => date("l d, Y h:i", $item->post_date),
                    ]; 
                };

                if(!empty($dataArray)){
                    echo json_encode($dataArray);        
                }
            break;

            case "postCatogory" :                  
                if($input->exist()){
                    $catogoryName   = !empty($input->get("data")["catogoryName"]) ? $input->get("data")["catogoryName"]   : NULL;
                    $alias          =  $setting->alias($catogoryName);

                    if(empty($catogoryName))                  {$errors = ["is geen catogorie opgegeven!"];}
                    if($blog->exist("catogory", $alias) > 0 ) {$errors = ["Catogorie bestaat al!"];}
                    if(!empty($input->exist()) and empty($errors)){                    
                        $postArray = [
                            "uuid"      =>  "{$setting->MakeUuid()}",
                            "name"      =>  "{$catogoryName}",
                            "alias"     =>  "{$alias}",
                            "post_data" =>  date("Y-m-d h:i:s", getdate()[0]), //0000-00-00 00:00:00
                        ];

                        

                        if($blog->postCatogory($postArray) > 0){
                                $dataArray =    [
                                    "data"          =>  "success",
                                    "dataContent"   =>  "systeem is bijgwerekt",
                                ];  
                        }else{
                                //errors
                                $dataArray =    [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "Er is een fout op getreden met de database.",
                                ];
                        };                  
                    }else{
                                //errors
                                $dataArray =    [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "{$errors[0]}",
                                ];
                    }
                                echo json_encode($dataArray);

                }         
            break;
        //end catogorys
        
        //begin tags
            case "getTags" :  
                foreach($blog->getTags() as $item){
                    $dataArray[] = [
                        "uuid"      => "{$item->uuid}",
                        "tags"      => "{$item->name}",
                        "alias"     => "{$item->alias}",
                        "date"      => date("l d, Y h:i", $item->post_date),
                    ]; 
                };

                if(!empty($dataArray)){
                    echo json_encode($dataArray);        
                }
            break;
        
            case "postTags" :
                if($input->exist()){
                    $tagName   = !empty($input->get("data")["tagName"]) ? escape($input->get("data")["tagName"])   : NULL;
                    $alias          =  $setting->alias($tagName);

                    if(empty($tagName))                       {$errors = ["is geen tag opgegeven!"];}
                    if($blog->exist("tags", $alias) > 0 ) {$errors = ["Tag bestaat al!"];}
                    if(!empty($input->exist()) and empty($errors)){                    
                        $postArray = [
                            "uuid"      =>  "{$setting->MakeUuid()}",
                            "name"      =>  "{$tagName}",
                            "alias"     =>  "{$alias}",
                            "post_data" =>  date("Y-m-d h:i:s", getdate()[0]),
                        ];

                        if($blog->postTags($postArray) > 0){
                                $dataArray =    [
                                    "data"          =>  "success",
                                    "dataContent"   =>  "systeem is bijgwerekt",
                                ];  
                        }else{
                                //errors
                                $dataArray =    [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "Er is een fout op getreden met de database.",
                                ];
                        };                  
                    }else{
                                //errors
                                $dataArray =    [
                                    "data"          =>  "error",
                                    "dataContent"   =>  "{$errors[0]}",
                                ];
                    }
                                echo json_encode($dataArray);
                } 
            break;

    }