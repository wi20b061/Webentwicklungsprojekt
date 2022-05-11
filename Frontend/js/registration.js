$(document).ready(function(){

    var form = document.getElementById("registrationForm")
    form.addEventListener("submit", event =>{
        event.preventDefault()
        validateForm()
    })
})  

// einfache validierung für frontend

// function to validate form input
function validateForm(){
    
    // retrieving values of form elements
    var fname = document.registrationForm.fname.value.trim()
    var lname = document.registrationForm.lname.value.trim()
    var streetname= document.registrationForm.streetname.value.trim()
    var streetnr = document.registrationForm.streetnr.value.trim()
    var zip = document.registrationForm.zip.value.trim()
    var location = document.registrationForm.location.value.trim()
    var country = document.registrationForm.country.value.trim()
    var usern = document.registrationForm.username.value.trim()
    var email = document.registrationForm.email.value.trim()
    var pw = document.registrationForm.pw.value.trim()
    var pw2 = document.registrationForm.pw2.value.trim()


    //defining errorMessage variables with default value
    var fnameErr = lnameErr = streetnErr = streetnrErr = zipErr = locErr = counErr = userErr = emailErr = pwErr = pw2Err = true 

    //validate first name
    if(fname == ""){
        printError("fnameErr", "fname", "Please enter your first name")
        //add error class for input field
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(fname) === false){
            printError("fnameErr", "fname", "Please enter valid first name")
            //add error class for input field
        }else{
            printError("fnameErr", "fname", "")
            fnameErr = false
            //add success class for input field
            //addSuccess(fname)
        }
    }

    //validate last name
    if(lname == ""){
        printError("lnameErr", "lname", "Please enter your last name")
        //add error class for input field
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("lnameErr", "lname", "Please enter valid last name")
            //add error class for input field
        }else{
            printError("lnameErr", "lname", "")
            lnameErr = false
            //add success class for input field
        }
    }

    //validate street name
    if(streetname == ""){
        printError("streetnErr", "streetn", "Please enter your streetname")
    }
    
    //validate streetnr
    if(streetnr == ""){
        printError("streetnrErr", "streetnr", "Please enter your streetnumber")
    }

    //validate zip
    if(zip == ""){
        printError("zipErr", "zip", "Please enter your zip code")
    }

    //validate location
    if(location == ""){
        printError("locErr", "location", "Please enter your location")
    }

    //validate country
    if(country == ""){
        printError("counErr", "country", "Please enter your country")
    }
    
    //validate usern
    if(usern == ""){
        printError("userErr", "username", "Please enter your username")
    }

    //validate email
    if(email == ""){
        printError("emailErr", "email", "Please enter your email")
    }else{
        //regex for email validation
        var regex = /^\S+@\S+\.\S+$/
        if(regex.test(email) === false){
            printError("emailErr", "email", "Please enter valid email")

        }else{
            printError("emailErr", "email", "")
            emailErr = false
            //add success class for input field

        }
    }

    //validate pw
    if(pw == ""){
        printError("pwErr", "pw", "Please enter your password")
    }else{
        //var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])(?=\\S+$).{8, 20}$/
        var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.{8,})/ // at least 1 lower case, 1 upper case, 1 number, white space not allowed
        if(regex.test(pw) === false){
            console.log(regex.test(pw))
            printError("pwErr", "pw", "Please enter valid password (min 8 characters)")
        }else{
            printError("pwErr", "pw", "")
            //add success class
            
            
        }
    }


}

//function to display error messages
function printError(elemErrId, elemInputId, message){
    document.getElementById(elemErrId).innerHTML = message
    //document.getElementById(elemInputId).style.borderColor = "red"
    //elemInputId.className = "form-controll error"
}

/*function addSuccess(input){
    input.className = "form-controll success"
}*/

// funktionen für eingabefelder ausarbeiten, auch logic folder
// ajax call in logic, utility klasse
/*function sendForm(){
    $.ajax({
        
    })
}*/