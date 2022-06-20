$(document).ready(function(){
   
    

    $('#save').click(function(){

        var img = "../productpictures/bookshelf.png"
        sendData(productName, price, description, type, img)
    })

})




function sendData(productName, price, description, type, img){
    console.log("before code ajax")

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