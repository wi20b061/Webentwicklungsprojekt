$(document).ready(function(){
   
    loadCart()
    console.log("hello")
})  

function loadCart(){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?userID=1&request=cart",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log('success')
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}