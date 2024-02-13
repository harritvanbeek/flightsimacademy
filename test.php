

<?php 
    die;
    define('_BOANN', 1);
    define('BPATH_BASE',    dirname(__FILE__) );

        require_once BPATH_BASE . '/includes/defines.php';
        require_once BPATH_BASE . '/includes/framework.php';   

    $fshub      =   NEW \api\fshub;
    $fshubID    =   2030;


    //$flichtdata = $fshub->get("airline/2030/flight");

    //debug( $fshub->get("pilot/7313/stats"), true );
    //$flichtdata = $fshub->get("pilot/7313");
    //debug($flichtdata);
    


    
    $userdata = $fshub->get("airline/{$fshubID}/pilot")->data;    
    //debug( $userdata, true );
    
    
    foreach($userdata as $user)
        {   
            if($user->is_online > 0){
                //debug($user->gps->lat, true);
                //debug($user->gps->lng, true);
                //debug( $user->name, true);
                //debug( $user, true);
                //debug("--------------------------------------", true);
                debug( $fshub->get("pilot/{$user->id}/flight")->data["0"], true );
            }
        }
