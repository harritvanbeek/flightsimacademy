<?php
//test
define('_BOANN', 1);
if (defined('_BOANN'))
    {
        //include default settings
        define('BPATH_BASE',    dirname(__FILE__) );

        require_once BPATH_BASE . '/includes/defines.php';
        require_once BPATH_BASE . '/includes/framework.php';    

        
        $view   = NEW \classes\view\renderView;
        $view->view($view);
    }
