$(document).ready(function () {

    if(getCookie('username')!= ""){
        $('#username').val(getCookie('username'))
    }

    $('#submit').click(function(){
        validateForm()
    })
})

function validateForm() {
    console.log("validation")
    var username = $('#username').val().trim()
    var pw = $('#pw').val().trim()
    
    

    var userErr = pwErr = true

    //validate usern
    if (username == "") {
        printError("userErr", "username", "Please enter your username")
    } else {
        //if (todo Datenbankabgleichung === false) {
        //    printError("userErr", "username", "Please enter valid username")
            //add error class for input field
        //}else{
            printError("userErr", "username", "")
            userErr = false
    }

    //validate usern
    if (pw == "") {
        printError("pwErr", "pw", "Please enter your password")
    } else {
        //if (todo Datenbankabgleichung === false) {
        //    printError("userErr", "username", "Please enter valid username")
            //add error class for input field
        //}
        printError("pwErr", "pw", "")
        pwErr = false
    }

    if(userErr == false && pwErr == false){
        console.log("keine errors")
        sendData("login", username, pw)
    }else{
        console.log(userErr)
        console.log("pw error: "+pwErr)
        console.log(pw)
    }
}

function printError(elemErrId, elemInputId, message){
    document.getElementById(elemErrId).innerHTML = message
    
    if(message == ""){
        document.getElementById(elemInputId).style.borderColor = "green"

    }else{
        document.getElementById(elemInputId).style.borderColor = "red"
        
    }
}

function sendData(methodToExecute, username, pw){
    var rememberMe = $('#setCookie').val()
    console.log(rememberMe)
    
    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {request: methodToExecute, username: username, pw: pw},
        dataType: "json",
        xhrFields:{withCredentials: true},
        success: function (response) { 
            if(rememberMe == 'checked'){
                document.cookie = setCookie('username', username, 7)
                console.log(getCookie('username'))
                console.log(document.cookie)
            }
            window.location.assign('../sites/products.php')
        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }
    })

   
}

function setCookie(cname, cvalue, exdays){
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}