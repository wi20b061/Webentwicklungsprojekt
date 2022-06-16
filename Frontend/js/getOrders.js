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
                saleshead.cartlineList.forEach(cartline =>{
                    rows+= " " + cartline.saleslineID + " " + cartline.productID + " " + cartline.productName;
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