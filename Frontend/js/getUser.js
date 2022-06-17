$(document).ready(function(){
   
    loadUsers()


})  

function loadUsers(){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?allUsers",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)

            var rows = ""
            var colCount
            
            response.forEach(user => {
                colCount += 1;
                rows += "<div class='row border p-2'>"+user.userID+"<div class='col ps-5 pe-5'>"+user.fname+" "+user.lname+"<br>"+user.username+"<br>"+user.email+"</div><div class='col'>"+user.streetname+"<br>"+user.zip+" "+user.location+"<br>"+user.country+"</div><div class='col'><button class='btn text-white loadOrders' onclick='loadOrders("+ user.userID +")' style='background-color: #365370;' type='link'>Orders</button></div><div class='col'><button class='btn text-white deactivate' onclick='deactivateUser("+ user.userID +")' style='background-color: #880808;' type='link'>Deaktivate</button></div></div>";
            });
           
            $('#userList').append(rows)
            

           
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })
}

function loadOrders(userID){

    window.location.assign('../sites/orders.php?userID=' + userID)
}

function deactivateUser(userID){

    window.location.assign('../sites/orders.php?userID=' + userID)
}