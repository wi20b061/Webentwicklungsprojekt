$(document).ready(function(){
   
    var userID = getUrlVars()["userID"]
    console.log(userID)
    loadOrders(userID)


})  

function loadOrders(userID){

    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?userID=" + userID + "&request=adminOrders",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            
            var rows= ""

            response.forEach(saleshead => {
                rows+= "<table class='table'><thead><tr><th scope='col'>Order ID</th><th scope='col'>Product and ID</th><th scope='col'>Quantity</th><th scope='col'>Image</th><th scope='col'></th></tr></thead><tbody>";
                saleshead.cartlineList.forEach(cartline =>{
                    rows+= "<tr><th scope='row'>"+cartline.saleslineID+"</th><td>"+cartline.productID+" "+cartline.productName+"</td><td>"+cartline.quantity+"</td><td><img src='../../Frontend/productpictures/bookshelf.p' alt='Bookshelf'></td><td id='btn"+cartline.saleslineID+"'><i class='bi bi-trash' onclick='deleteProduct("+ saleshead.customerID +", "+cartline.productID+")' type='link'></i></td></tr>";
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

function deleteProduct(userID, productID){
//todo
console.log('jaman')

    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        data: {request:"user", userRequest:"deactivateUser", userID:"1"},
        success: function (response) { 
            console.log(response)
            $("#btn"+userID).empty()
            $("#btn"+userID).append("<button class='btn text-white deactivate' onclick='deactivateUser("+ user.userID +")' style='background-color: #880808;' disabled type='link'>Deaktivate</button>")
    
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })
}