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

    $('#newProduct').click(function () {
        window.location.assign('../sites/newProduct.php')
    })
})



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


                rows += '<div class="col m-2 border-bottom"><div class="product" id="' + colCount + '"><div class="row"><img class="img-fluid mx-auto d-block " src="' + product.path + '"></div><div class="row"><div class="col"><strong>' + product.name + '</strong><br>' + product.description.substr(0, 20) + '...<br>' + product.price.toFixed(2) + ' €</div></div></div></div>';

                if (colCount % 4 == 0) {

                    rows += '</div><div class="row ps-2 pe-2">';
                }
            });

            $('#products').append(rows)

            $('.bi').mouseenter(function () {

            })
            $('.product').click(function () {
                console.log(this.id)
                window.location.assign('../sites/productDetailsProcessing.php?productID=' + this.id)
            })


        },
        error: function (xhr) {
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        },
    })
}