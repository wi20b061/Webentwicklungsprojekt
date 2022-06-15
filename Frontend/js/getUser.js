$(document).ready(function(){
   
    loadUsers()

})  

function loadProducts(getMethod){
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?user",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)

            var rows = ""
            
            response.forEach(user => {
                colCount += 1;
                rows += "<div class='row border ps-2 pe-2'>User ID<div class='col ps-5 pe-5'>Fname Lname<br>Username<br>test@email.com</div><div class='col'>Teststraße 3<br>1130 Wien<br>Austria</div><div class='col'><button class='btn text-white' style='background-color: #365370;' type='link'>Orders</button></div></div>";
            });
           
            $('#userList').append(rows)

           
        },
        error: function(xhr){
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })
}