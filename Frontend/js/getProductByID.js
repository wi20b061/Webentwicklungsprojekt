$(document).ready(function(){

    //getting the productID from the url
    var productID = getUrlVars()["productID"];
    
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?productID=" +productID , //productID="+ productID[0]
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            $('#img').append('<img class="img-fluid mx-auto d-block " src="' + response.path + '">')
            $('#name').append('<h1 class="display-6">' +response.name +'</h1>')
            $('#price').append('<p class="text-muted" >'+ response.price.toFixed(2) +'€</p>')
            $('#description').append('<p>'+ response.description +'</p>')
            $('#addToCart').append('<button type="button" onclick="addToCart('+response.id+')" class="btn btn-dark" style="background-color: #365370;">Add to cart <i class="bi bi-basket-fill ms-1" style="font-size: 1.5rem; color: white;"></i></button>')
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

function addToCart(productID) {
    console.log("addedToCart")
    console.log(productID)
    var sessionIsSet = $('#sessionIsSet').html()

    if(sessionIsSet == 'true'){
        $.ajax({
            type: "POST",
            url: "../../Backend/ServiceHandler.php",
            cache: false,
            dataType: "json",
            
            data: { request: "order", orderRequest: "addProduct", productID: productID, quantity: "1" },
            success: function (response) {
                var productCount = parseInt($('#productCount').text())
                // produktcount um 1 erhöhen
                $('#productCount').html(productCount + 1)
                
            },
            error: function (xhr) {
                console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    }else{
        window.location.assign('../sites/login.php')
    }

    
}


// https://newbedev.com/get-querystring-from-url-using-jquery
// Read a page's GET URL variables and return them as an associative array.
function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}