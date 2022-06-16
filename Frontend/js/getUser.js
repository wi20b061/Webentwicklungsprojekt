$(document).ready(function(){
   
    loadUsers()

})  

function loadUsers(getMethod){
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
                rows += "<div class='row border ps-2 pe-2'>"+user.userID+"<div class='col ps-5 pe-5'>"+user.fname+" "+user.lname+"<br>"+user.username+"<br>"+user.email+"</div><div class='col'>"+user.streetname+"<br>"+user.zip+" "+user.location+"<br>"+user.country+"</div><div class='col'><button class='btn text-white' style='background-color: #365370;' type='link'>Orders</button></div></div>";
            });
           
            $('#userList').append(rows)


           
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })
}