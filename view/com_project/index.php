<?php 
    define('_BOANN', 1);
    require_once dirname(dirname(dirname(__file__))).'/libraries/import.php';
    $action     =   !empty($_GET["action"]) ? $_GET["action"] : null;
    $env        = NEW \classes\core\env;

    $githubUser = $env->get('githubUser');
    $githubToke = $env->get('githubToke');

    switch($action){
        case "get_projects" :        
            $curl_url           = "https://api.github.com/users/{$githubUser}/repos";  
            $curl_token_auth    = 'Authorization: token ' . $token; 
            $ch                 = curl_init($curl_url); 
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App', $githubToke));

            $json_data = curl_exec($ch);
            curl_close($ch);

            $output = json_decode($json_data);
            if (!empty($output)) {
                // now you could just foreach the repos and show them
                foreach ($output as $repo) {
                    if(!empty($repo->language))
                        $array[]    =   [
                            "name"          =>  "{$repo->name}",
                            "description"   =>  "{$repo->description}",
                            "html_url"      =>  "{$repo->html_url}",
                            "language"      =>  "{$repo->language}",
                            "created_at"    =>  "{$repo->created_at}",
                            "updated_at"    =>  "{$repo->updated_at}",
                            "pushed_at"     =>  "{$repo->pushed_at}",
                        ];
                }

                echo json_encode($array);
            }    
                        
        break;
    }
