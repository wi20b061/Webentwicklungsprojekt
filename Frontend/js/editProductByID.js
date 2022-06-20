$(document).ready(function(){

    //getting the productID from the url
    var productID = getUrlVars()["productID"];
    
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?productID=" +productID , //productID="+ productID[0]
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            $('#img').append('<img class="img-fluid mx-auto d-block " src="' + response.path + '">')
            $('#name').append('<h1 class="display-6">' +response.name +'</h1>')
            $('#price').append('<p class="text-muted" >'+ response.price.toFixed(2) +'€</p>')
            $('#description').append('<p>'+ response.description +'</p>')
            $('#type').append('<div class="dropdown"><button class="btn text-white dropdown-toggle" disabled style="background-color: #365370;" type="button" data-bs-toggle="dropdown" aria-expanded="false">' +response.type +'</button></div>')
            //$('#ID').append('<h3 class="display-6">' +response.productID +'</h3>')
            $('#edit').append('<button type="button" onclick="edit('+response.name+', '+response.name+')" class="btn btn-dark mt-1" style="background-color: #365370;">Edit <i class="bi bi-pencil ms-1" style="font-size: 1.5rem; color: white;"></i></button>')
            $('#delet').append('<button type="button" onclick="delet('+response.id+')" class="btn btn-dark mt-1" style="background-color: #880808;">Delete <i class="bi bi-trash ms-1" style="font-size: 1.5rem; color: white;"></i></button>')
        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        },
        complete: function(){
            console.log("ajax call completed")
        }

    })

})  

function edit(response) {

    console.log(response)
    $("#name").empty()
    $('#name').append('<input type="text" class="form-control display-6" id="name" value=" '+response.name +'">')
    $("#price").empty()
    $('#price').append('<input type="text" class="form-control" id="price" value="' + response.price.toFixed(2) +'">')
    $("#description").empty()
    $('#description').append('<input type="text" class="form-control" id="description" value="' + response.description +'">')
    $("#type").empty()
    $('#type').append('<label class="form-label" for="type1" >'+response.type+'</label><select class="form-select" id="type1" name="type1"><option value="shelf">Shelf</option><option value="couch">Couch</option><option value="plants">Plants</option><option value="decoration">Decoration</option></select>')
    $("#edit").empty()
    $('#edit').append('<button type="button" onclick="saveEdit('+document.getElementByID("name").innerText()+','+document.getElementByID("price").innerText()+', '+document.getElementByID("description").innerText()+', '+document.getElementByID("type").innerText()+')" class="btn btn-dark" style="background-color: #365370;">Save <i class="bi bi-pencil ms-1" style="font-size: 1.5rem; color: white;"></i></button>')

    

    
}

function saveEdit(name, price, description, type){

    $.ajax({
        type: "POST",
        url: "../../Backend/ServiceHandler.php",
        cache: false,
        dataType: "json",
        
        data: { request: "products", productsRequest: "update", name: name, price: price, description: description, type: type},
        success: function (response) {
  
            window.location.assign('../sites/productProcessing.php')
        },
        error: function (xhr) {
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    })
}

function delet(productID) {
    console.log("delete")


        $.ajax({
            type: "POST",
            url: "../../Backend/ServiceHandler.php",
            cache: false,
            dataType: "json",
            
            data: { request: "products", productsrequest: "delete", productID: productID},
            success: function (response) {
      
                window.location.assign('../sites/productProcessing.php')
            },
            error: function (xhr) {
                console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })


    
}


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