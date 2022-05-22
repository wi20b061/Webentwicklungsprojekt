$(document).ready(function(){
   
    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {method: "products", request: "id" /*hier die id des produktes mit übergeben*/ },
        dataType: "json",
        success: function (response) { 
            console.log(response)
           console.log("ajax call success")
        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        },
        complete: function(){
            console.log("ajax call completed")
        }

    })

})  