var articlePageToggle = function(page,navTo){

    $('.article-pages').attr('data-page',page);

    if(typeof navTo !== 'undefined'){
        setTimeout(function(){
            if(navTo === 'top'){
                $('html,body').animate({scrollTop : $('.article-pages').offset().top - $('.site-header').innerHeight()},200);
            }

            else{
                $('html,body').animate({scrollTop : $('#'+navTo).offset().top - $('.site-header').innerHeight()},200);
            }

        },200);
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

