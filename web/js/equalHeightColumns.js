$( document ).ready(function() {
    var heights = $('.col-lg-4.col-md-6.text-center').map(function() {
        return $(this).height();
    }).get(),
    maxHeight = Math.max.apply(null, heights);

    $('.col-lg-4.col-md-6.text-center').height(maxHeight);
});