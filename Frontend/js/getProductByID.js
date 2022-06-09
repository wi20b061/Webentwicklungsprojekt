$(document).ready(function(){
   
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?productID=1",
        cache: false,
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