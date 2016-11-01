var articlePageToggle = function(page,navTo){
    var timing = 200;
    $('.article-pages').attr('data-page',page);

    if(typeof navTo !== 'undefined'){
        setTimeout(function(){
            if(navTo === 'top'){
                $('html,body').animate({scrollTop : $('.article-pages').offset().top - $('.site-header').innerHeight()},timing);
            }

            else{
                $('html,body').animate({scrollTop : $('#'+navTo).offset().top - $('.site-header').innerHeight()},timing);
            }

        },timing);
    }
}

$(function(){

    $('.article-page-toggle').on('click',function(e){

        e.preventDefault();

        var page = $(this).attr('data-page'),
            navTo = $(this).attr('data-nav-to');

        articlePageToggle(page,navTo);
    });
});

