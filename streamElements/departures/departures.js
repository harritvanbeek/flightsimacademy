departureDate();
// Refresh the page after a delay of 3 seconds
setInterval(function(){
    //location.reload();
    departureDate();    
}, 3000); // 3000 milliseconds = 3 seconds


function departureDate(){
    readTextFile("flicht_info.php", function(text){
        $('tbody').empty();
        var data = JSON.parse(text);    
        for (let i = 0; i < data.length; i++) {  
            $('tbody').append(`
                <tr class="flicht_info">
                    <td class="white">${data[i].departure}</td>
                    <td class="white">${data[i].destination}</td>
                    <td class="white">${data[i].distends}</td>
                    <td class="white">${data[i].flight}</td>
                    <td class="white">${data[i].gate}</td>
                    <td class="white">${data[i].plain}</td>
                </tr>    
            `);                   
        }

        $('tbody').show();
    });    
}


function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}