

$(document).ready(function(){
   
    //später in ajax call success function schreiben und hier weglöschen
    // Name des Produktes soll bei mouseover event underlined werden
    /*$("product").mouseenter(function(){
        $("productName").css("text-decoration", "underline")
    
    })*/

    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?products",
        cache: false,
        dataType: "json",
        success: function (response) { 
            console.log(response)
            var colCount = 0;
            
            var rows = '<div class="row ps-2 pe-2">';

            response.forEach(product => {
                colCount += 1;

               
                rows += '<div class="col m-2 border-bottom product" id="'+ colCount + '">'+ '<img class="img-fluid mx-auto d-block " src="' + product.path + '"><strong>' +product.name + '</strong><br>'+ product.description.substr(0, 20) + '...<br>' + product.price.toFixed(2) +' €</div>';

                if(colCount % 4 == 0){
                    
                    rows += '</div><div class="row ps-2 pe-2">';
                }
            });

            $('#products').append(rows)
            $('.product').click(function(){
                console.log(this.id)
                window.location.assign('../sites/productDetails.php?productID=' + this.id)
            })

        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);   
        },
    })

})  

