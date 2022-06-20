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
            $('#content').append('<div class="col"><div class="row" style="font-weight: bold;">Salutation</div><div class="row">'+ response.salutation.toUpperCase() +'</div><div class="row" style="font-weight: bold;">Name</div><div class="row">'+ response.fname +' '+response.lname+'</div><div class="row" style="font-weight: bold;">E-Mail</div><div class="row">'+response.email +'</div></div><div class="col"><div class="row" style="font-weight: bold;">Address</div><div class="row">'+ response.streetname+' '+response.streetnr+'</div><div class="row">'+ response.zip+' ' +response.location +'</div><div class="row">'+response.country+'</div></div><div class="col"><button type="button" onclick="updateUserData('+ response.salutation.toString()+', '+ response.fname +')" class="btn btn-dark m-2" style="background-color: #365370;">Edit Profile<i class="bi bi-pencil-square" style="font-size: 1rem; color: white;"></i></button></div>')
            $('#helloUsername').html(response.username)
            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

function updateUserData(salutation){
    $('#content').empty()
    $('#content').append('<div  id="updateUserForm"  name="updateUserForm" ><label class="form-label" for="salutation" >Salutation</label><select class="form-select" id="salutation" name="salutation" ><option value="mr">Mr.</option><option value="ms">Ms.</option><option value="various">Various</option></select><div class="row mt-1"><div class="col"><label for="fname" class="form-label">Firstname</label><input type="text"id="fname" name="fname" class="form-control" ><div class="text-danger " id="fnameErr" name="fnameErr"></div></div><div class="col"><label for="lname" class="form-label">Lastname</label><input type="text" id="lname" name="lname" class="form-control" ><div class="text-danger" id="lnameErr" name="lnameErr"></div></div></div><div class="row mt-1"><div class="col"><label for="streetname" class="form-label">Streetname</label><input type="text" class="form-control" id="streetname" name="streetname" ><div class="text-danger" id="streetnErr" name="streetnErr"></div></div><div class="col"><label for="streetnumber" class="form-label">Streetnumber</label><input type="text" class="form-control" id="streetnumber" name="streetnumber" ><div class="text-danger" id="streetnrErr" name="streetnrErr"></div></div></div><div class="row mt-1"><div class="col"><label for="zip" class="form-label">Zip Code</label><input type="text" class="form-control" id="zip" name="zip" ><div class="text-danger" id="zipErr" name="zipErr"></div></div><div class="col"> <label for="location" class="form-label">Location</label><input type="text" class="form-control" id="location" name="location" ><div class="text-danger" id="locErr" name="locErr"></div></div></div><label for="country" class="form-label mt-1">Country</label><input type="text" class="form-control" id="country" name="country" ><div class="text-danger" id="counErr" name="counErr"></div><div class="row mt-1"><div class="col"><label for="email" class="form-label">Email</label><input type="text" class="form-control" id="email" name="email" ><div class="text-danger" id="emailErr" name="emailErr"></div></div></div><button class="btn text-white mt-2 mb-2"  name="submit" id="submit" style="background-color: #365370;">Submit</button></div>')
    /*$.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        data: {request: 'user', userRequest: 'updateUserData'},
        success: function (response) {
            console.log(response)
            $('#content').append('')

            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })*/
}


function loadOrders(){
    // Ajax call machen
    $('#content').empty()


    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?request=orders",
        cache: false,
        dataType: "json",
        success: function (response) {
            console.log(response)
            $('#content').append('')

            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })




}