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
    var streetnr = document.registrationForm.streetnumber.value.trim()
    var zip = document.registrationForm.zip.value.trim()
    var location = document.registrationForm.location.value.trim()
    var country = document.registrationForm.country.value.trim()
    var usern = document.registrationForm.username.value.trim()
    var email = document.registrationForm.email.value.trim()
    var pw = document.registrationForm.pw.value.trim()
    var pw2 = document.registrationForm.pw2.value.trim()
    
    //defining errorMessage variables with default value
    var fnameErr = lnameErr = streetnErr = streetnrErr = zipErr = locErr = counErr = userErr = emailErr = pwErr = true 

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
        printError("streetnErr", "streetname", "Please enter your streetname")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("streetnErr", "streetname", "Please enter valid streetname")
            //add error class for input field
        }else{
            printError("streetnErr", "streetname", "")
            streetnErr = false
            //add success class for input field
        }
    }
    
    //validate streetnr
    if(streetnr == ""){
        printError("streetnrErr", "streetnumber", "Please enter your streetnumber")
    }else{
        var regex = /^[0-9]*$/
        if(regex.test(lname) === false){
            printError("streetnrErr", "streetnumber", "Please enter valid streetnumber")
            //add error class for input field
        }else{
            printError("streetnrErr", "streetnumber", "")
            streetnrErr = false
            //add success class for input field
        }
    }

    //validate zip
    if(zip == ""){
        printError("zipErr", "zip", "Please enter your zip code")
    }else{
        var regex = /^[0-9]*$/
        if(regex.test(lname) === false){
            printError("zipErr", "zip", "Please enter valid zip code")
            //add error class for input field
        }else{
            printError("zipErr", "zip", "")
            zipErr = false
            //add success class for input field
        }
    }


    //validate location
    if(location == ""){
        printError("locErr", "location", "Please enter your location")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("locErr", "location", "Please enter valid location")
            //add error class for input field
        }else{
            printError("locErr", "location", "")
            locErr = false
            //add success class for input field
        }
    }

    //validate country
    if(country == ""){
        printError("counErr", "country", "Please enter your country")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("counErr", "country", "Please enter valid country")
            //add error class for input field
        }else{
            printError("counErr", "country", "")
            counErr = false
            //add success class for input field
        }
    }
    
    //validate usern
    if(usern == ""){
        printError("userErr", "username", "Please enter your username")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("userErr", "username", "Please enter valid username")
            //add error class for input field
        }else{
            printError("userErr", "username", "")
            userErr = false
            //add success class for input field
        }
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
    if(pw == "" || pw2 == ""){
        printError("pwErr", "pw", "Please enter your password")
        
    }else{
        // wenn beide befüllt dann error zurücksetzen
        printError("pwErr", "pw", "")
        //var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&-+=()])(?=\\S+$).{8, 20}$/
        var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.{8,})/ // at least 1 lower case, 1 upper case, 1 number, white space not allowed
        if(regex.test(pw) === false){
            
            printError("pwErr", "pw", "Please enter valid password")
        }else{
            printError("pwErr", "pw", "")
            
            if(pw != pw2){
                printError("pwErr", "pw", "Passwords don't match")
            }else{
                printError("pwErr", "pw", "")
                
                //add success class
            }
            
        }
    }

    


}

//function to display error messages
function printError(elemErrId, elemInputId, message){
    document.getElementById(elemErrId).innerHTML = message
    
    if(message == ""){
        document.getElementById(elemInputId).style.borderColor = "green"
        if(elemInputId = pw){
            document.getElementById("pw2").style.borderColor = "green"
        }
    }else{
        document.getElementById(elemInputId).style.borderColor = "red"
        
        if(elemInputId = pw){
            
            document.getElementById("pw2").style.borderColor = "red"
        }
        
    }
}

// funktionen für eingabefelder ausarbeiten, auch logic folder
// ajax call in logic, utility klasse
/*function sendForm(){
    $.ajax({
        
    })
}*/