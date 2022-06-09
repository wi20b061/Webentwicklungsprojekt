

$(document).ready(function(){
   
    //später in ajax call success function schreiben und hier weglöschen
    // Name des Produktes soll bei mouseover event underlined werden
    $("product").mouseenter(function(){
        $("productName").css("text-decoration", "underline")
    
    })

    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?products",
        cache: false,
        dataType: "json",
        success: function (response) { 
            
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
