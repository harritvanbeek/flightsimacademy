<?php if($this->_PAGE === "map"){
    include $view->RenderPages();  
    include "footerScripts.php"; 
}else{ 
    include "header.php"; ?>

    <div ui-view="navbar"></div>
    <div ui-view="mainpage"></div>
    <div ui-view="footer"></div>

<?php 
    include "footerScripts.php"; 
 } ?>
