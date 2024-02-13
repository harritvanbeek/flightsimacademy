    <?php if($_SERVER["SERVER_NAME"] !== "www.flightsimacademy.net") : ?>
        <script id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.27.10'><\/script>".replace("HOST", location.hostname));
    //]]></script>
    <?php endif;?>


    <script type="text/javascript" src="<?php echo THEMES; ?>/js/jquery.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/jquery-ui.min.js?v=<?php echo getdate()[0]; ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script src="https://embed.twitch.tv/embed/v1.js?v=<?php echo getdate()[0]; ?>"></script>
    
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/popper.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/bootstrap.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/mdb.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/sweetalert.min.js?v=<?php echo getdate()[0]; ?>"></script>

    <script type="text/javascript" src="<?php echo THEMES; ?>/js/angular.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/angular-sanitize.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/angular-ui-router.js?v=<?php echo getdate()[0]; ?>"></script>

    <script type="text/javascript" src="<?php echo THEMES; ?>/js/app.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/boann.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/boann.controller.min.js?v=<?php echo getdate()[0]; ?>"></script>
    
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/maps.js?v=<?php echo getdate()[0]; ?>"></script>
    
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-79730470-1', 'auto');
        ga('send', 'pageview');
        /*console.clear();*/
    </script>
</body>
</html>
