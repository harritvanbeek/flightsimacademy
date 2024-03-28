<?php


    define('_BOANN', 1);
    define('BPATH_BASE',    dirname(__FILE__) );

        require_once BPATH_BASE . '/includes/defines.php';
        require_once BPATH_BASE . '/includes/framework.php';   

    $fshub      =   NEW \api\fshub;
    $fshubID    =   2030;

    $userdata = $fshub->get("airline/{$fshubID}/pilot")->data;    
    foreach($userdata as $user)
        {   
            /* if($user->name === "Bryan Nijssen"){
                debug($user->name, 1);
                debug($user->gps->lat, 1);
                debug($user->gps->lng, 1);

            } */
            
            if($user->is_online > 0){
                debug($user->gps->lat, true);
                debug($user->gps->lng, true);
                debug( $user->name, true);
                debug( $user, true);
                debug("--------------------------------------", true);
                debug( $fshub->get("flight/{$user->id}")->data, true );
                debug("--------------------------------------", true);
                debug( $fshub->get("pilot/{$user->id}/flight")->data["0"], true );
            }
            
        }




        
