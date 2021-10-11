$(function(){

    console.log("aaaa");


  

})





$("#basesetting").click(function(){

 // Avoid the real one
 event.preventDefault();
$(".DropMenu-BaseSet").toggle().css({
    top: event.pageY +20+ "px",
    left: event.pageX + "px"
});;


})


$("#readerControl").click(function(){
    event.preventDefault();
    $(".DropMenu-ReaderOperation").toggle().css({
        top: event.pageY +20+ "px",
        left: event.pageX + "px"
    });;


})


$("#DataQuiery").click(function(){
    event.preventDefault();
    $(".DropMenu-History").toggle().css({
        top: event.pageY +20+ "px",
        left: event.pageX + "px"
    });;
})


$("#Tool").click(function(){
    event.preventDefault();
    $(".DropMenu-Tools").toggle().css({
        top: event.pageY +20+ "px",
        left: event.pageX + "px"
    });;
})

$("#SystemSetting").click(function(){
    event.preventDefault();
    $(".DropMenu-SystemParameter").toggle().css({
        top: event.pageY +20+ "px",
        left: event.pageX + "px"
    });;
})






