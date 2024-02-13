if(document.getElementById('googlemap')){ //chek or this id element exist!
    var getZoom       = 3;
    var setZoom       = 4;
    var refresh       = 35000;
    var who_json_url  = "../libraries/callback/callback_msfs.php?action=get_flights_json";
    
    function urlify(text) {
        var urlRegex = /(((https?:\/\/)|(www\.))[^\s]+)/g;
        return text.replace(urlRegex, function(url,b,c) {
            var url2 = (c == 'www.') ?  'http://' +url : url;
            return '<a href="' +url2+ '" target="_blank">' + url + '</a>';
        })
    }
    
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
    
    function fetch_aircraft(set_bounds){
      $.ajax({
        url:who_json_url,
        dataType:"json",
        success:function(locations){        
            if(locations !== null){
                $("#NoFlights").hide();
                render_aircraft(locations);
            }else{
                $("#googlemap").hide();
                $("#flight-info-wrapper").hide();
            }
    
      },
        error:function(xhr, status, error){
          var errorMessage = xhr.status + ': ' + xhr.statusText
          console.log('Error - ' + errorMessage);
        }
      });
    }
    
    function render_aircraft(locations){
            console.log(locations);
            var infowindow = new google.maps.InfoWindow();
            bounds  = new google.maps.LatLngBounds();
            markers = new Array();
    
            // loop through the locations of aircraft, making google map markers
            for (i = 0; i < locations.length; i++) {
              // create a new marker
                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(locations[i]["latitude"], locations[i]["longitude"]),
                        icon: {
                            path: "M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z",
                            fillColor: 'darkblue',
                            fillOpacity: 1,
                            anchor: new google.maps.Point(12, 12),
                            strokeWeight: 1,
                            scale: 2,
                            rotation: parseInt(locations[i]["heading"])
                        }
                });
    
                markers.push(marker);
    
                // add the marker position to the bounds object
                bounds.extend(marker.getPosition());
    
                // show a label when a marker is clicked
                google.maps.event.addListener(marker, 'click', (function(marker, i) { return function() 
                  {
                      if(locations[i]["callsign"] !== 'N/A'){
                        localStorage.setItem("callsign", locations[i]["callsign"]);
                        $("#flight-info-wrapper").fadeIn();
                      }
                  }



              })(marker, i));    
    
            } // loop
    
    
            // if a callsign is not passed in, zoom the map to it - else fit all the aircraft
            if (getParameterByName("callsign") == null) {
                // fit the map to the markers being shown
                if (set_bounds) {
                  map.fitBounds(bounds);
                  map.setZoom(setZoom);
                  set_bounds = false;
                }
            }
    }
    
    function timer(){
        // clear existing markers
        for(var i=0; i < markers.length; i++){
          markers[i].setMap(null);
        }
        markers = [];
        fetch_aircraft(false);
    }
    
    function comparer(index) {
      return function(a, b) {
        var valA = getCellValue(a, index), valB = getCellValue(b, index)
        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
      }
    }
    
    var bounds = null;
    var set_bounds = true;
    var markers = [];
    
    var map = new google.maps.Map(document.getElementById('googlemap'), {
        disableDoubleClickZoom: true,
        draggable: true,
        scrollwheel: true,

        disableDefaultUI: true,
        //streetViewControl: false,
        //scaleControl: false,
        //navigationControl: false,
        //mapTypeControl: false,
        //zoomControl: false,
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });
    
    $('th').click(function(){
      var table = $(this).parents('table').eq(0)
      var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
      this.asc = !this.asc
      if (!this.asc){rows = rows.reverse()}
      for (var i = 0; i < rows.length; i++){table.append(rows[i])}
    })
    
    function getCellValue(row, index){
        return $(row).children('td').eq(index).text()
    }
    
    // wait for jQuery
    $(document).ready(function(){
        console.log("Ready!");
        fetch_aircraft(true);
        console.log(refresh);
        window.setInterval(timer, refresh);
    
        /*$("#googlemap").css("width","100%");
        $("#googlemap").css("height","100%");*/
    });
}
