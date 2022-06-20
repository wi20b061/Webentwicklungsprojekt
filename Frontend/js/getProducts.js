

$(document).ready(function () {


    
    loadProducts("products")
    
    $('.dropdown-item').click(function () {
        var filter = $(this).text()
        //filter = filter.slice(0, filter.length - 1)
        console.log(filter)
        $("#dropdownMenuButton1").html(filter)
        
        loadProducts("category=" + filter.toLowerCase())
    })

    $('#search').keyup(function () {
        var searchField = $('#search').val();
        $("#dropdownMenuButton1").html("Category")
        liveSearch(searchField)
    })
})

//products get dynamically loaded, for each product a div gets created up to 4 div boxes - then next line
function loadProducts(getMethod) {
    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?" + getMethod,
        cache: false,
        dataType: "json",
        success: function (response) {
            $('#products').empty()
            console.log(response)
            var colCount = 0;

            var rows = '<div class="row ps-2 pe-2">';

            response.forEach(product => {
                colCount += 1;

                var price = product.price /100

                rows += '<div class="col m-2 border-bottom"><div class="product" id="' + colCount + '"><div class="row"><img class="img-fluid mx-auto d-block " src="' + product.path + '"></div><div class="row"><div class="col"><strong>' + product.name + '</strong><br>' + product.description.substr(0, 20) + '...<br>' + price.toFixed(2) + ' €</div></div></div><div  class="row text-end mt-1 mb-1"><button onclick="addToCart(' + colCount + ')" type="button" class="btn text-white btn-sm" style="background-color: #365370; border-color:#365370;">Add to cart <i class="bi bi-basket-fill ms-1"  style=" color: white;"></i></button></div></div>';

                if (colCount % 4 == 0) {

                    rows += '</div><div class="row ps-2 pe-2">';
                }
            });

            $('#products').append(rows)

            //on click the detailed product info gets shown
            $('.product').click(function () {
                console.log(this.id)
                window.location.assign('../sites/productDetails.php?productID=' + this.id)
            })


        },
        error: function (xhr) {
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        },
    })
}

function addToCart(productID) {
    console.log("addedToCart")
    console.log(productID)
    var sessionIsSet = $('#sessionIsSet').html()
    console.log($('#productCount').html())
    if(sessionIsSet == 'true'){
        $.ajax({
            type: "POST",
            url: "../../Backend/ServiceHandler.php",
            cache: false,
            dataType: "json",
            //auf login verweisen falls kein user eingeloggt ist
            data: { request: "order", orderRequest: "addProduct", productID: productID, quantity: "1" },
            success: function (response) {
                var productCount = parseInt($('#productCount').text())
                // produktcount um 1 erhöhen

                $('#productCount').empty()
                $('#productCount').html(productCount + 1)
                
            },
            error: function (xhr) {
                console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        })
    }else{
        window.location.assign('../sites/login.php')
    }

    
}

function liveSearch(searchterm) {
        $.ajax({
            type: "GET",
            url: "../../Backend/ServiceHandler.php?search="+searchterm,
            cache: false,
            dataType: "json",
            success: function (response) {
                $('#products').empty()
                console.log("search completed")
                var colCount = 0;

                var rows = '<div class="row ps-2 pe-2">';

                response.forEach(product => {
                    colCount += 1;


                    rows += '<div class="col m-2 border-bottom"><div class="product" id="' + colCount + '"><div class="row"><img class="img-fluid mx-auto d-block " src="' + product.path + '"></div><div class="row"><div class="col"><strong>' + product.name + '</strong><br>' + product.description.substr(0, 20) + '...<br>' + product.price.toFixed(2) + ' €</div></div></div><div  class="row text-end mt-1 mb-1"><button onclick="addToCart(' + colCount + ')" type="button" class="btn text-white btn-sm" style="background-color: #365370; border-color:#365370;">Add to cart <i class="bi bi-basket-fill ms-1"  style=" color: white;"></i></button></div></div>';

                    if (colCount % 4 == 0) {

                        rows += '</div><div class="row ps-2 pe-2">';
                    }
                });

                $('#products').append(rows)

                $('.bi').mouseenter(function () {

                })
                $('.product').click(function () {
                    console.log(this.id)
                    window.location.assign('../sites/productDetails.php?productID=' + this.id)
                })
            },
            error: function (xhr) {
                console.log("ajax call error")
                console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);

            },

        })
    };
