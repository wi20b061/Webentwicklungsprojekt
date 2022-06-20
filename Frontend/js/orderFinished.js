$(document).ready(function(){
   
    var salesheaderID = getUrlVars()["salesheaderID"];

    $('#invoiceLink').append('<a href="../../Backend/ServiceHandler.php?request=invoice&salesheaderID='+salesheaderID+'" class="btn btn-dark" style="background-color: #365370;" target="_blank" rel="noopener noreferrer">View invoice</a>')
    
})  

// https://newbedev.com/get-querystring-from-url-using-jquery
// Read a page's GET URL variables and return them as an associative array.
function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}