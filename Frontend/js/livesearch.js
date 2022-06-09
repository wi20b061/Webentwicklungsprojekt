$(document).ready(function(){


$('#search').keyup(function()
{
    var searchField=$('#search').val();
    var myExp=new RegExp(searchField,"i");
    var slct_start='<select>';
    $('#top').html(slct_start);

    $.ajax({
        type: "GET",
        url: "../../Backend/ServiceHandler.php?products",
        cache: false,
        dataType: "json",
        success: function (response) { 
            var output='<ul class="searchresults">';    

            $.each(response,function(key,val){
    
                if(val.name.search(myExp)!=-1)
                {
                 output='<option '+'value='+val.name+'>'+val.name+'</option>';
    
                }
            });
                $('#center').html(output);

        },
        error: function(xhr){
            console.log("ajax call error")
            console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            
        },
        complete: function(){
            console.log("ajax call completed")
        }

    })
    var slct_end='</select>';
    $('#bottom').html(slct_end);
});

})