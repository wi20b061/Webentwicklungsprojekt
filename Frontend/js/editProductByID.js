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
            $('#delet').append('<button type="button" onclick="delet('+response.id+')" class="btn btn-dark mt-1" style="background-color: #880808;">Delete <i class="bi bi-trash ms-1" color: white;"></i></button>')


        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        },
        complete: function(){
            console.log("ajax call completed")
        }

    })


    $('#save').click(function(){


        

        //second ajax call to get Picture path
        $.ajax({
            type: "GET",
            url: "../../Backend/ServiceHandler.php?productID=" +productID , //productID="+ productID[0]
            cache: false,
            dataType: "json",
            success: function (response) {
                
                var productName = $('#productName').val();
                var price = $('#price').val();
                var description = $('#description').val();
                var select = document.getElementById('type1');
                var type = select.options[select.selectedIndex].value


                console.log(response)
                sendData(productID, productName, price, description, type, response.path)
    
    
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

})

//send Data to uptate product
function sendData(productID, productName, price, description, type, path){
    console.log("before code ajax")

    $.ajax({
        
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {request: "products", productsrequest: "update", productID:productID, name: productName, description: description, type: type, price: price, img:path},
        dataType: "json",
        success: function (response) { 

            window.location.assign('../sites/productProcessing.php')
        },
        error: function(xhr){
            
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }

    })

}

//delete Product from Database, if Product is already in use, send error message
function delet(productID) {
    console.log("delete")


        $.ajax({
            type: "POST",
            url: "../../Backend/ServiceHandler.php",
            cache: false,
            dataType: "json",
            
            data: { request: "products", productsrequest: "delete", productID: productID},
            success: function (response) {
      
                window.location.assign('../sites/productProcessing.php')
            },
            error: function (xhr) {
                console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })


    
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