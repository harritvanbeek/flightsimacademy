"use strict";

var d = new Date();
var controler = {
  view : './view/com_',
  version : d.getTime()
}

var setDebug = true;
var logger = function()
{
    var oldConsoleLog = null;
    var pub = {};

    pub.enableLogger =  function enableLogger() 
    {
        if(oldConsoleLog == null)
            return;
            window['console']['log'] = oldConsoleLog;
    };

	pub.disableLogger = function disableLogger()
    {
        oldConsoleLog = console.log;
        window['console']['log'] = function() {};
    };

    return pub;
}();

$(document).ready(
    function(){    
	    if(setDebug){
	    	logger.enableLogger();
	    }else{
	    	var cssRule =
	    		"color: red;" +
	    		"font-size: 60px;" +
	    		"font-weight: bold;";
			console.log("%cStop!", cssRule);
		
			var cssRule =
		    	"font-weight: bold;" +
		    	"font-size: 12pt;";
			console.log("%cThis is a browser feature intended for developers. If someone told you to copy-past somthing here to enable a website feature or 'hack' someone`s account, it is a scam and will give them access to your account", cssRule);
			logger.disableLogger();
	    }  
    }
 );

var UrlData =   window.location.href.split("/")[3];
    //$(".page-footer").removeClass("boann_footer");
if(UrlData !== ''){
    //$(".page-footer").addClass("boann_footer");
};


var boann = angular.module('BoannApp', ['ngSanitize', 'ui.router']);   
var boannA = angular.module('BoannFlight', ['ngSanitize']); 


//upload images;
var uploadImages = function(PostURI){
    (function(){
        var dropzone = document.getElementById("dropzone");

        var upload = function(files){
            var formData = new FormData(),
            xhr = new XMLHttpRequest(),
            x;

            formData.append('file', files[0]);
            
            /*for(x = 0; x < files[0]; x = x + 1){
            }*/

            xhr.onload = function(){
                //var data = this.responseText;
                var data = JSON.parse(this.responseText);

                $(".dropzone-icon").fadeOut();

                $(".dropImg").delay(1000).fadeIn(500);
                document.getElementById("img").src = data.img;

                console.log(data.img);

            }

            xhr.open('post', PostURI);
            xhr.send(formData);

        }

        dropzone.ondrop = function(e){
            e.preventDefault();
            this.className = "dropzone";
            upload(e.dataTransfer.files);
        };

        dropzone.ondragover = function(){
            this.className = "dropzone dragover";
            return false;
        };

        dropzone.ondragleave = function(){
            this.className = "dropzone";
            return false;
        };            
    }());
}
