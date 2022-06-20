$(document).ready(function(){
   
    

    $('#save').click(function(){
        sendData(img, productname, price, description, type)
    })

})




function sendData(img, productName, price, description, type){
    console.log("before code ajax")

    $.ajax({
        
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {img: img, productName: productName, price: price, description: description, type: type},
        dataType: "json",
        success: function (response) { 

            window.location.assign('../sites/login.php')
        },
        error: function(xhr){
            
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }

    })

}