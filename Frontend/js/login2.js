$(document).ready(function () {

    //var form = document.getElementById("LoginForm")
    /*form.addEventListener("submit", event => {
        event.preventDefault()
        validateForm()
        
    })*/

    $('#submit').click(function(){
        validateForm()
    })
})

function validateForm() {
    console.log("validation")
    var username = document.LoginForm.username.value.trim()
    var pw = document.LoginForm.pw.value.trim()


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
    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        data: {request: methodToExecute, username: username, pw: pw},
        dataType: "json",
        success: function (response) { 

           console.log("ajax call success")
        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        }
    })

    console.log("nach ajax call")
    return
}