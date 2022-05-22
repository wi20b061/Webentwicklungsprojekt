$(document).ready(function () {

    var form = document.getElementById("LoginForm")
    form.addEventListener("submit", event => {
        event.preventDefault()
        validateForm()
    })
})

function validateForm() {
    var username = document.LoginForm.username.value.trim()
    var pw = document.LoginForm.pw.value.trim()

    var userErr = pwErr = true

    //validate usern
    if (usern == "") {
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
        userErr = false
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
        url: "",
        cache: false,
        data: {method: methodToExecute, username: username, password: pw},
        dataType: "json",
        beforeSend: function(){
            console.log("befor Send ajax call")
        },
        success: function (response) { 

           console.log("ajax call success")
        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        },
        complete: function(){
            console.log("ajax call completed")
        }

    })

    console.log("nach ajax call")
    return
}