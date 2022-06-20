$(document).ready(function(){
   
    console.log('document loaded')


})




function sendData(){
    console.log("before code ajax")
    var img = "../productpictures/bookshelf.png"
    

    var productName = $('#')

    $.ajax({
        
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {request: "products", productsrequest: "newProduct", name: productName, description: description, type: type, price: price, img: img},
        dataType: "json",
        success: function (response) { 

            window.location.assign('../sites/productProcessing.php')
        },
        error: function(xhr){
            
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }

    })

}