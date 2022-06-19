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
            $('#content').append('<div class="col"><div class="row" style="font-weight: bold;">Salutation</div><div class="row">'+ response.salutation.toUpperCase() +'</div><div class="row" style="font-weight: bold;">Name</div><div class="row">'+ response.fname +' '+response.lname+'</div><div class="row" style="font-weight: bold;">E-Mail</div><div class="row">'+response.email +'</div></div><div class="col"><div class="row" style="font-weight: bold;">Address</div><div class="row">'+ response.streetname+' '+response.streetnr+'</div><div class="row">'+ response.zip+' ' +response.location +'</div><div class="row">'+response.country+'</div></div><div class="col"><button type="button" onclick="loadOrders()" class="btn btn-dark m-2" style="background-color: #365370;">Edit Profile<i class="bi bi-pencil-square" style="font-size: 1rem; color: white;"></i></button></div>')
            $('#helloUsername').html(response.username)
            
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
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