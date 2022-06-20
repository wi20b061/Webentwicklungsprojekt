$(document).ready(function(){
   
    loadPersonalData()
    $('#personalData').click(loadPersonalData)
    $('#orders').click(loadOrders)

})  

function loadPersonalData(){
    // Ajax call machen
    $('#content').empty()
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?userProfile",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            var salutation = response.salutation
            $('#content').append('<div class="col"><div class="row" style="font-weight: bold;">Salutation</div><div class="row">'+ response.salutation.toUpperCase() +'</div><div class="row" style="font-weight: bold;">Name</div><div class="row">'+ response.fname +' '+response.lname+'</div><div class="row" style="font-weight: bold;">E-Mail</div><div class="row">'+response.email +'</div></div><div class="col"><div class="row" style="font-weight: bold;">Address</div><div class="row">'+ response.streetname+' '+response.streetnr+'</div><div class="row">'+ response.zip+' ' +response.location +'</div><div class="row">'+response.country+'</div></div><div class="col"><button type="button" onclick="updateUserData(\''+response.salutation+'\',\''+response.fname+'\',\''+response.lname+'\',\''+response.streetname+'\',\''+response.streetnr+'\',\''+response.location+'\',\''+response.zip+'\',\''+response.country+'\',\''+response.email+'\')" class="btn btn-dark m-2" style="background-color: #365370;">Edit Profile<i class="bi bi-pencil-square" style="font-size: 1rem; color: white;"></i></button></div>')
            $('#helloUsername').html(response.username)
            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

function updateUserData(salutation, fname, lname, streetname, streetnr, location, zip, country, email){
    $('#content').empty()
    $('#content').append('<div  id="updateUserForm"  name="updateUserForm" ><label class="form-label" for="salutation" >Salutation</label><select class="form-select" id="salutation" name="salutation" ><option  selected disabled hidden>'+salutation+'</option><option value="mr">Mr.</option><option value="ms">Ms.</option><option value="various">Various</option></select><div class="row mt-1"><div class="col"><label for="fname" class="form-label">Firstname</label><input type="text"id="fname" name="fname" class="form-control" value="'+fname+'"><div class="text-danger " id="fnameErr" name="fnameErr"></div></div><div class="col"><label for="lname" class="form-label">Lastname</label><input type="text" id="lname" name="lname" class="form-control" value="'+lname+'"><div class="text-danger" id="lnameErr" name="lnameErr"></div></div></div><div class="row mt-1"><div class="col"><label for="streetname" class="form-label">Streetname</label><input type="text" class="form-control" id="streetname" name="streetname" value="'+streetname+'"><div class="text-danger" id="streetnErr" name="streetnErr"></div></div><div class="col"><label for="streetnumber" class="form-label">Streetnumber</label><input type="text" class="form-control" id="streetnumber" name="streetnumber" value="'+streetnr+'"><div class="text-danger" id="streetnrErr" name="streetnrErr"></div></div></div><div class="row mt-1"><div class="col"><label for="zip" class="form-label">Zip Code</label><input type="text" class="form-control" id="zip" name="zip" value="'+zip+'"><div class="text-danger" id="zipErr" name="zipErr"></div></div><div class="col"> <label for="location" class="form-label">Location</label><input type="text" class="form-control" id="location" name="location" value="'+location+'"><div class="text-danger" id="locErr" name="locErr"></div></div></div><label for="country" class="form-label mt-1">Country</label><input type="text" class="form-control" id="country" name="country" value="'+country+'"><div class="text-danger" id="counErr" name="counErr"></div><div class="row mt-1"><div class="col"><label for="email" class="form-label">Email</label><input type="text" class="form-control" id="email" name="email" value="'+email+'"><div class="text-danger" id="emailErr" name="emailErr"></div></div></div><button class="btn text-white mt-2 mb-2"  onclick="saveChanges()" name="save" id="save" style="background-color: #365370;">Save Changes</button></div>')
}

function saveChanges(){

    var select = document.getElementById('salutation');
    var salutation = select.options[select.selectedIndex].value
    var fname = $('#fname').val().trim()
    var lname = $('#lname').val().trim()
    var streetname= $('#streetname').val().trim()
    var streetnr = $('#streetnumber').val().trim()
    var zip = $('#zip').val().trim()
    var location = $('#location').val().trim()
    var country = $('#country').val().trim()
    var email = $('#email').val().trim()

    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        data: {request: 'user', userRequest: 'updateUserData', salutation: salutation, fname: fname, lname: lname, streetname: streetname, streetnr: streetnr, zip: zip, location: location, country: country, email: email},
        success: function (response) {
            console.log(response)

           
            loadPersonalData()

            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

//orders get loaded
function loadOrders(){
    
    $('#content').empty()

    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?request=orders",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            
            var rows="<div class='col'>"
            response.forEach(order =>{
                console.log(order)
                
                rows += '<div class="row border-bottom pb-1 mb-1 mt-2" style="font-weight: bold;" ><div class="col">Order Nr. ' + order.salesheaderID +'</div><div class="col text-end"><a href="../../Backend/ServiceHandler.php?request=invoice&salesheaderID='+order.salesheaderID+'" class="btn btn-dark btn-sm" style="background-color: #365370;" target="_blank" rel="noopener noreferrer">View invoice</a></div></div>'
                order.cartlineList.forEach(product=>{

                    var price = product.productprice/100
                    console.log(price)
                    rows += '<div class="row mb-1"><div class="col img'+product.saleslineID+'"></div><div class="col">'+product.quantity+'</div><div class="col">'+product.productName+'</div><div class="col">'+price.toFixed(2)+'</div></div>'
                    loadProductPic(product.productID, product.saleslineID)
                })
                rows += '</div>'
            })
            $('#content').append(rows)

            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })




}
//product Pictures get loaded
function loadProductPic(productID, saleslineID){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?productID=" +productID ,
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            
            
            $('.img' + saleslineID).append("<img class='img-fluid' style='max-width: 40%;' src='"+ response.path +"'>")
            
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }
    })
}

