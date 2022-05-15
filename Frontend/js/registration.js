$(document).ready(function(){
   
    var form = document.getElementById("registrationForm")
    form.addEventListener("submit", event =>{
        event.preventDefault()
        validateForm()
                
    })
})  

// function to validate form input
function validateForm(){
    
    // retrieving values of form elements
    var select = document.getElementById('salutation');
    var salutation = select.options[select.selectedIndex].value
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
        
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(fname) === false){
            printError("fnameErr", "fname", "Please enter valid first name")
           
        }else{
            printError("fnameErr", "fname", "")
            fnameErr = false
            
        }
    }

    //validate last name
    if(lname == ""){
        printError("lnameErr", "lname", "Please enter your last name")
        
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(lname) === false){
            printError("lnameErr", "lname", "Please enter valid last name")
            
        }else{
            printError("lnameErr", "lname", "")
            lnameErr = false
            
        }
    }

    //validate street name
    if(streetname == ""){
        printError("streetnErr", "streetname", "Please enter your streetname")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(streetname) === false){
            printError("streetnErr", "streetname", "Please enter valid streetname")
            
        }else{
            printError("streetnErr", "streetname", "")
            streetnErr = false
            
        }
    }
    
    //validate streetnr
    if(streetnr == ""){
        printError("streetnrErr", "streetnumber", "Please enter your streetnumber")
    }else{
        var regex = /^[0-9]*$/
        if(regex.test(streetnr) === false){
            printError("streetnrErr", "streetnumber", "Please enter valid streetnumber")
            
        }else{
            printError("streetnrErr", "streetnumber", "")
            streetnrErr = false
            
        }
    }

    //validate zip
    if(zip == ""){
        printError("zipErr", "zip", "Please enter your zip code")
    }else{
        var regex = /^[0-9]*$/
        if(regex.test(zip) === false){
            printError("zipErr", "zip", "Please enter valid zip code")
            
        }else{
            printError("zipErr", "zip", "")
            zipErr = false
            
        }
    }


    //validate location
    if(location == ""){
        printError("locErr", "location", "Please enter your location")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(location) === false){
            printError("locErr", "location", "Please enter valid location")
            
        }else{
            printError("locErr", "location", "")
            locErr = false
            
        }
    }

    //validate country
    if(country == ""){
        printError("counErr", "country", "Please enter your country")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(country) === false){
            printError("counErr", "country", "Please enter valid country")
            
        }else{
            printError("counErr", "country", "")
            counErr = false
            
        }
    }
    
    //validate usern
    if(usern == ""){
        printError("userErr", "username", "Please enter your username")
    }else{
        var regex = /^[a-zA-Z\s]+$/
        if(regex.test(usern) === false){
            printError("userErr", "username", "Please enter valid username")
            
        }else{
            printError("userErr", "username", "")
            userErr = false
            
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
                
            }
            
        }
    }

    
    if((fnameErr || lnameErr || streetnErr || streetnrErr || zipErr || locErr || counErr || userErr || emailErr || pwErr) == false){
        return false
    }else{
        sendData("registration", salutation, fname, lname, streetname, streetnr, zip, location, country, usern, email, pw)
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

// ajax function in ajax.js auslagern
function sendData(methodToExecute, salutation, fname, lname, streetname, streetnumber, zip, location, country, username, pw){
    $.ajax({
        type: "POST",
        url: "",
        cache: false,
        data: {method: methodToExecute, salutation: salutation, fname: fname, lname: lname, streetname: streetname, 
                streetnr: streetnumber, zip: zip, location: location, country: country, username: username, 
                password: pw},
        dataType: "json",
        success: function (response) { 
           
        },
        
    })
}