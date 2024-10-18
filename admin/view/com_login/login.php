<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="fragment" content="!">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- <base href="/"> -->
    <title>BOANN | Admin</title>    
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    
    <link href="<?php echo ADMIN_THEMES; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEMES; ?>/css/mdb.min.css" rel="stylesheet">
    <link href="<?php echo ADMIN_THEMES; ?>/css/boann.min.css?v=<?php echo $_SERVER["REQUEST_TIME"]; ?>" rel="stylesheet">
    <link href="<?php echo ADMIN_THEMES; ?>/js/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <style type="text/css">/* Chart.js */
    @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
</head>

<body ng-app="BoannApp">
    <div class="application loginPage" ng-controller="LoginController">
        
        <div class="background_container">
            <div class="fullpage_container">
                <div class="background_assets"></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6 login">
                    <h1 class="text-center">Admin</h1>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label>Email / Username :</label>
                            <input class="form-control" ng-model="form.name" type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label>password :</label>
                            <input class="form-control" ng-model="form.password" type="password" name="password">
                        </div>

                        <div class="form-check mb-2 mr-sm-2">
                            <input class="form-check-input" ng-model="form.remeber" type="checkbox" id="inlineFormCheckMD">
                            <label class="form-check-label" for="inlineFormCheckMD">
                              Remeber
                            </label>
                      </div>
                      <hr>
                      <div class="form-group">                              
                        <button ng-click="submit(form)" class="btn btn-sm btn-primary">LogIn</button>                        
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if(TeamDev()) : ?><?php endif;?>
    <script type="text/javascript" id="__bs_script__">//<![CDATA[
    document.write("<script type='text/javascript' async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
//]]></script>
    

    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/jquery-ui-1.12.1/jquery-ui.js"></script>
    
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/mdb.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/angular-sanitize.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/angular-ui-router.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/ui-bootstrap-tpls-2.5.0.min.js"></script>
    
    <!-- <script type="text/javascript" src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>  -->

    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/sweetalert.min.js?v=<?php echo $_SERVER["REQUEST_TIME"]; ?>"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/app.js?v=<?php echo $_SERVER["REQUEST_TIME"]; ?>"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/boann.min.js?v=<?php echo $_SERVER["REQUEST_TIME"]; ?>"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/boann.controller.min.js?v=<?php echo $_SERVER["REQUEST_TIME"]; ?>"></script> 
    
    <script type="text/javascript" src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=lh5bb6qr4nj86oxh5tb3f6m1unv9czc0nulyr14imdpccn28"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_THEMES; ?>/js/tinymce.js"></script>
    


</body>
