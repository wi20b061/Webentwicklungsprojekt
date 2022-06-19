$(document).ready(function(){
    
    var sessionIsSet = $('#sessionIsSet').html()
    console.log(sessionIsSet)
    
    
    $('#shoppingCart').click(function(){
        if(sessionIsSet == 'true'){
            window.location.assign('../sites/shoppingCart.php')
        }else{
            window.location.assign('../sites/login.php')
        }
        
    })

    //get cart for current user to print total qty of products in cart
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?request=cart",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)

            var qty = 0
            

            response.cartlineList.forEach(item=>{
                qty += item.quantity
            })
            

            $('#productCount').append(qty)
            
            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })

})  