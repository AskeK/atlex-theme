$(function(){

    $('.js-menu').on('click', function(e){

        var a = $(e.target),
            href = a.attr('href'),
            li = a.parent('li'),
            ul = li.parents('ul'),
            nav = ul.parents('nav');



        // Only fire on anchors
        if (!a.is('a, a *')){return;}

        // Click on active parent
        if(li.is('.current-menu-parent, .current-menu-item') && !li.is('.sub-menu li') && !nav.is('.sub-nav')){
            e.preventDefault();
            toggleArticle(e,$('main').find('a[href="'+href+'"]').parents('article'));
            ul.find('li').removeClass('current-menu-item');
            li.addClass('current-menu-item');
        }

        // Click on inactive parent
        else if(!li.is('.sub-menu li') ){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item open');

            if($(this).is('.sub-nav')){
                e.preventDefault();
            }
        }

        // Click on active child
        else if(li.is('.sub-menu li.current-menu-item')){
            e.preventDefault();
        }

        // Click on inactive child
        else if(li.is('.sub-menu li') && !nav.is('.sub-nav')){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item').parents('li').addClass('current-menu-parent open');
            e.preventDefault();

            toggleArticle(e,$('main').find('a[href="'+href+'"]').parents('article'));
        }

    });
});
