$(document).ready(function(){
   
    console.log('document loaded')


})



//send data to create a new Product in database
function sendData(){
    console.log("before code ajax")


    var img = "../productpictures/vase2.jpg"
    var productName = $('#productName').val();
    var price = $('#price').val();
    var description = $('#description').val();
    var select = document.getElementById('type1');
    var type = select.options[select.selectedIndex].value

    console.log(type)

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