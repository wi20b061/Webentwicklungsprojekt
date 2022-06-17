$(document).ready(function(){
   
    var userID = getUrlVars()["userID"]
    console.log(userID)
    loadOrders(userID)


})  

function loadOrders(userID){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?userID=" + userID + "&request=orders",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            
            var rows= ""

            response.forEach(saleshead => {
                rows+= "<table class='table'><thead><tr><th scope='col'>Order ID</th><th scope='col'>Product and ID</th><th scope='col'>Quantity</th><th scope='col'>Image</th></tr></thead><tbody>";
                saleshead.cartlineList.forEach(cartline =>{
                    rows+= "<tr><th scope='row'>"+cartline.saleslineID+"</th><td>"+cartline.productID+" "+cartline.productName+"</td><td>"+cartline.quantity+"</td><td><img src='../../Frontend/productpictures/bookshelf.p' alt='Bookshelf'></td></tr>";
                })
            });

            rows+= "</tbody></table>"

            $('#orders').append(rows)
           
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
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