var toggleArticle = function(e, article){

    if(article.is('.collapsed')){
        $('body').removeClass('toggle-aside');

        e.preventDefault();
        $('main .main-article').removeClass('current expanded').addClass('collapsed');
        article.removeClass('collapsed').addClass('current expanded');
        $('html,body').animate({scrollTop: article.offset().top - $('.site-header').innerHeight()},100);
    }
}

$('body').on('click .main-article.collapsed',function(e){
    var t = $(e.target),
        article = t.parents('article');

    toggleArticle(e, article);

});
