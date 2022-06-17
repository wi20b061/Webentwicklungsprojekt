$(document).ready(function(){
   
    loadCart()
    
    
})  

function loadCart(){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?request=cart",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            var rows =""
            
            response.cartlineList.forEach(item=>{
                // ajax call to get product pic and description
                loadProductDetails(item.productID)
                var priceQty = item.productprice*item.quantity
                rows += '<div class="row mt-3 border-bottom pb-2 me-1"><div class="col-md-3 img'+ item.productID +'"></div><div class="col-md"><p style="font-weight: bold;">'+item.productName +'</p><p class="text-muted details'+ item.productID +'"></p><p class="text-muted">'+ item.productprice +' /piece</p><br><i  class="bi bi-dash-circle" onclick="changeProductQty('+ item.saleslineID+', '+ parseInt(item.quantity-1) +')"></i> '+ item.quantity +' <i  class="bi bi-plus-circle-fill" onclick="changeProductQty('+ item.saleslineID+', '+ parseInt(item.quantity+1) +')"></i></div><div class="col-md-auto">'+ priceQty.toFixed(2) +'</div></div>';
                
                    
                
            })
            
            $('#cart').append(rows)
            $('#subtotal').empty()
            $('#subtotal').append(response.sumprice.toFixed(2))
            var totalExcl = response.sumprice * 0.8
            $('#totalExcl').empty()
            $('#totalExcl').append(totalExcl.toFixed(2))
            var ust = response.sumprice * 0.2
            $('#ust').empty()
            $('#ust').append(ust.toFixed(2))
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

function loadProductDetails(productID){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?productID=" +productID ,
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            
            $('.details'+ productID).append(response.description )
            $('.img' + productID).append("<img class='img-fluid' src='"+ response.path +"'>")
            
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }
    })
}

function changeProductQty(saleslineID, newQty){
    console.log('heyooo')
    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        //auf login verweisen falls kein user eingeloggt ist
        data: { request: "order", orderRequest: "updateQty", newQty: newQty, salesLineID: saleslineID },
        success: function (response) {
            
            
            $('#cart').empty()
            loadCart()
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}