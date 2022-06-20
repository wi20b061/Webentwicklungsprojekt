$(document).ready(function(){
   
    loadSummary()
    loadUserAddress()
    
})  

function loadSummary(){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?request=cart",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            
            $('#btnOrder').click(function(){
                order(response.salesheaderID)
            })

            var sumprice = response.sumprice /100
            console.log(sumprice)

            $('#product').append(sumprice.toFixed(2))
            
            var total = parseInt($('#shipping').html()) + sumprice
           
            $('#total').append(total.toFixed(2))


            var ust = total * 0.2
            var totalExcl = total * 0.8
            
            $('#totalExcl').append(totalExcl.toFixed(2))
            $('#ust').append(ust.toFixed(2))

            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

function loadUserAddress(){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?userProfile",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            $('#shippingAddress').append('<div class="row"><div class="col">'+response.streetname+' '+response.streetnr+'<br>'+response.zip+' '+response.location+'<br>'+response.country+'</div></div>')

        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })
}

function order(salesheaderID){
    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        data: {request: 'order', orderRequest: 'completeOrder'},
        success: function (response) { 
            console.log(response)
            window.location.assign('../sites/orderFinished.php?salesheaderID='+salesheaderID)
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })

}
