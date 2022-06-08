$(document).ready(function(){
   
   $('#personalData').click(loadPersonalData)
   $('#orders').click(loadOrders)

})  

function loadPersonalData(){
    // Ajax call machen
    $('#content').empty()
    $('#content').append('<div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>')
}

function loadOrders(){
    // Ajax call machen
    $('#content').empty()
    $('#content').append('<div>Sit amet, consetetur Lorem ipsum dolorsadipsod tempor invidunt ucing elitr, sed diam nonumy eirmt labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>')

}