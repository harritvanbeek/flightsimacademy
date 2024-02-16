<?php $env = NEW \classes\core\env; ?>
  <!DOCTYPE html>
  <html lang="en">
  <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Flicht Sim Academy World Map</title>
      <script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Organization",
          "@id": " https://www.flightsimacademy.net/ ",
          "name" : " flightsimacademy ",
          "url": " https://www.flightsimacademy.net/ ",
          "email": " info@flightsimacademy.net ",
          "telephone": "  ",
          "address": {
              "@type": "PostalAddress",
              "streetAddress": " ",
              "addressLocality": "",
              "postalCode": " ",
              "addressCountry": "NL"
          },
          "logo": "<?php echo THEMES; ?>/img/fsa_logo.png", "sameAs" :
          [
              "  ",
              "  ",
              " https://www.youtube.com/channel/UCDCmk95z9hTEqfJlyYPPKRA ",
              " https://www.instagram.com/harritvanbeek/ ",
              " https://twitter.com/harritvanbeekie/ ",
              "  "
          ]
        }
      </script>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="robots" content="max-snippet:-1,max-image-preview:standard,max-video-preview:-1">
      <meta name="Keywords" content="Microsoft Flight Simulator">
      <meta name="Description" content="Microsoft Flight Simulator Academy is the next generation to lurn to fly.">
      <meta name="Author" content="flightsimacademy, Harrit Van Beek">
      <meta name="robots" content="index,follow">
      <meta name="GOOGLEBOT" content="INDEX, FOLLOW">
      <meta name="rating" content="general">
      <meta name="copyright" content="flightsimacademy.net. all rights reserved.">
      <meta name="publisher" content="flightsimacademy.net">
      <link rel="canonical" href="https://www.flightsimacademy.net">
      <link rel="shortcut icon" type="image/x-icon" href="<?php echo THEMES; ?>/img/fsa_logo.png">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

      <meta name="twitter:card" content="summary">
      <meta name="twitter:description" content="Microsoft Flight Simulator Academy is the next generation to lurn to fly.">
      <meta name="twitter:title" content="Microsoft Flight Simulator Academy, do you will lurn to fly ?">
      <meta name="twitter:image" content="<?php echo THEMES; ?>/img/fsa_logo.png">

      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

      <link rel="stylesheet" href="<?php echo THEMES; ?>/css/bootstrap.min.css?v=<?php echo getdate()[0]; ?>">
      <link rel="stylesheet" href="<?php echo THEMES; ?>/css/mdb.min.css?v=<?php echo getdate()[0]; ?>">
      <link rel="stylesheet" href="<?php echo THEMES; ?>/css/animate.css?v=<?php echo getdate()[0]; ?>">
      <link rel="stylesheet" href="<?php echo THEMES; ?>/css/boann.min.css?v=<?php echo getdate()[0]; ?>">
      
     <link rel="stylesheet" href="<?php echo THEMES; ?>/css/flightmap.css?v=<?php echo getdate()[0]; ?>">
      
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css?v=<?php echo getdate()[0]; ?>" />
     
      
  <body ng-app="BoannFlight" class="boannApp">
      <div ng-controller="FlichtSimController">
        <div class="content-container">
          
          <div class="mb-1 navbar navbar-expand-lg fixed-top map_nav">
            <div class="container-fluid">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <img class="logoImg" width="50%" alt="Flight Sim Academy" src="./assets/fsa_full_logo-logo.png">
              </div>
              <div class="col-md-4">
                  <div class="float-left">
                    <span class="items-baseline">
                      <span class="text-white text-base" ng-bind-html="setTime"></span>
                      <span class="text-white text-xs">UTC</span>
                    </span>
                    
                    <div class="searchBox float-right">
                      <input class="form-control" id="searchBox" autocomplete="off" type="text" placeholder="" class="">                  
                    </div>
                  </div>
                    
                  <div class="buttons float-right">                      
                      <button class="login" type="button">
                        <div class="fas fa-user"></div>
                        <div class="long_text">basic</div>
                      </button>
                      
                      <button class="menu" type="button">
                        <span class="fas fa-bars"></span>
                      </button>                      
                  </div>

              </div>
            </div>                      
          </div>

          <div id="googlemap"></div>
          
         
          <div id="flight-info-wrapper" class="panel-wrapper flight-info-warper">
            <div id="airlineInfo">
                <div class="callsign"> 
                    <span class="h3" ng-bind-html="flight.callsign"></span> 
                    <span ng-bind-html="flight.flight_number"></span>
                </div>

                <div class="network">
                    <a class="close-panel" ng-click="close(flight.callsign)"><i class="fas fa-times"></i></a>
                    <a href="{{flight.networkLnk}}" target="_blank" class="logo"><img height="20px" title="{{flight.network}}" ng-src="{{flight.networkImg}}"></a>
                </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="aircraft-image">
                <a target="_blank" href="./#!/wall/">
                  <img class="planes" ng-src="{{flight.aircraft.images}}">
                </a>

                <div>
                  <span ng-bind-html="flight.aircraft.name"></span>
                </div>
            </div>

            <div class="flight-info">
                <div class="orginal">
                  <ul class="orginal_location">
                    <li><h2 ng-bind-html="flight.departure.icao"></h2></li>
                    <li><h3 ng-bind-html="flight.departure.name"></h3></li>
                  </ul>
                </div>

                <div class="arrival">
                    <ul class="arrival_location">
                      <li><h2 ng-bind-html="flight.arrival.icao"></h2></li>
                      <li><h3 ng-bind-html="flight.arrival.name"></h3></li>
                    </ul>
                </div>
            </div>

            <div class="time-info">
                  <ul class="departure_time">
                    <li><span>scheduled :</span>
                        <time ng-bind-html="flight.currentLocation.departure_time"></time>
                      </li>
                  </ul>

                  <ul class="arrival_time">
                    <li><span>scheduled :</span>
                        <time ng-bind-html="flight.currentLocation.estimated_arrival_time"></time>
                      </li>
                  </ul>
            </div>

            <div class="time-info">
                  <ul class="departure_time">
                    <li><span>actual :</span>
                        <time ng-bind-html="flight.currentLocation.time_flown"></time>
                      </li>
                  </ul>

                  <ul class="arrival_time">
                    <li><span>estimated :</span>
                        <time ng-bind-html="flight.currentLocation.time_remaining"></time>
                      </li>
                  </ul>
            </div>
            <div class="clearfix"></div>

            <div class="p-4 text-center w-100" style="background: white;">
              <div class="progress" style="height: 20px;">
                <div class="progress-bar" role="progressbar" style="width: {{progress}}%; height:20px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> {{progress}}%</div>
              </div>
              <span ng-bind-html="flight.currentLocation.distance_flown"></span> NM, <span ng-bind-html="flight.currentLocation.distance_remaining"></span>

            </div>

            <div class="clearfix"></div>

            <div class="pnl-component altitude-chart">
              <div class="content-area">
                  <div class="top-bar-area">
                    <h2>Speed & Altitude graph</h2>
                  </div>
              </div>
            </div>

            <div class="time-info">
                  <ul class="departure_time">
                    <li><span>Speed :</span> <span ng-bind-html="flight.currentLocation.groundspeed"></span> <span>KTS</span></li>                    
                  </ul>

                  <ul class="arrival_time">
                    <li><span>Altitude :</span> <span ng-bind-html="flight.currentLocation.altitude"></span> <span>ft</span></li>                    
                  </ul>
            </div>

            <div class="clearfix"></div>
            
            <div class="pnl-component altitude-chart" style="border-top: 0.2rem solid #fff;">
              <div class="content-area">
                  <div class="top-bar-area">
                    <h2>Route</h2>
                  </div>
              </div>
            </div>

            <div class="route-info" style="background:#e9ecef; padding: 10px;">
                <span ng-bind-html="flight.route"></span>
            </div>

            <div class="clearfix"></div>
            <div class="footer" style="padding: 0.6rem 0.8rem 0.5rem 0.8rem; border-bottom-left-radius: inherit; border-bottom-right-radius: inherit;">test</div>

          </div>


      </div>
      </div>

    </body>
  </html>
    <script type="text/javascript" src="<?php echo THEMES; ?>/js/jquery.min.js?v=<?php echo getdate()[0]; ?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $env->get('GoogleApis'); ?>"></script>
