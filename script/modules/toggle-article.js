var toggleArticle = function(e, article, close){

    if(close === true && article.hasClass('post-type-forlob')){
        e.preventDefault();

        articlePageToggle(2,'top');
    }

    else if(close === true){
        e.preventDefault();
        article.removeClass('expanded').addClass('collapsed');
        $('html,body').animate({scrollTop: article.offset().top - $('.site-header').innerHeight()},100);
    }

    else if(article.hasClass('inner-article')){
        e.preventDefault();
        $('.inner-article').removeClass('expanded').addClass('collapsed');
        article.removeClass('collapsed').addClass('expanded');

        $('body').removeClass('toggle-aside');
        $('html,body').animate({scrollTop: article.offset().top - $('.site-header').innerHeight()},100);
        jio_data_img.scan();
    }

    else if(article.is('.post-type-forlob')){
        e.preventDefault();
        var target = '.article-page-single';

        $(target).empty();

        $('body').removeClass('toggle-aside');

        article.clone().appendTo(target).removeClass('collapsed').addClass('expanded');

        articlePageToggle(3,'top');
        loadInners(article,target);
    }

    else if(article.is('.collapsed')){
        $('body').removeClass('toggle-aside');

        e.preventDefault();
        $('main .main-article').removeClass('current expanded').addClass('collapsed');
        article.removeClass('collapsed').addClass('current expanded');
        $('html,body').animate({scrollTop: article.offset().top - $('.site-header').innerHeight()},100);

        var id = article.attr('id').replace('post-','');
    }
}

$('body').on('click', '.main-article.collapsed .article-link',function(e){
    var t = $(e.target),
        article = t.parents('article');

    toggleArticle(e, article, false);

});

$('body').on('click', '.main-article.expanded .article-close-link',function(e){
    var t = $(e.target),
        article = t.parents('article');

    toggleArticle(e, article, true);

});


$('body').on('click', '.inner-article.collapsed .article-link',function(e){
    var t = $(e.target),
        article = t.parents('.inner-article');
    toggleArticle(e, article);
});
