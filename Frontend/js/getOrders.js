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
                rows+= "<div class='row'>"+ saleshead.salesheaderID +" "+ saleshead.customerID;
                rows+= "<div class='row pe-5'>ID<div class='col ps-5 pe-5'>Product and ID</div><div class='col'>Quantity</div><div class='col'>Image</div></div>";
                saleshead.cartlineList.forEach(cartline =>{
                    rows+= "<div class='row border p-2 '> "+cartline.saleslineID+"<div class='col ps-5 pe-5'>"+cartline.productName+" "+cartline.productID+"</div><div class='col'>"+cartline.quantity+"</div><div class='col'><img src='../../Frontend/productpictures/bookshelf.png' alt='Bookshelf' style='width:60px;height:60px;'></div></div>";
                })
            });

            rows+= "</div>"

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