function showWindow(name) {
    $('.window[rel="'+name+'"]').css({
        'display':'flex'
    });
    $('body').css({
        'overflow':'hidden'
    });
}
function closeWindow() {
    $('.window').css({
        'display':'none'
    });
    $('body').css({
        'overflow':'auto'
    });
}
$(function () {
   $('.window .close').on('click',function () {
       closeWindow();
   });
    $('.window').on('click',function (e) {
        if (e.target == this){
            closeWindow();
        }
    });
});