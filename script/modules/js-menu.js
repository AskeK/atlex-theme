$(function(){

    $('.js-menu li').on('click',function(e){

        var a = $(e.target),
            li = a.parent('li'),
            ul = li.parents('ul');


        if(li.is('.current-menu-parent, .current-menu-item') && !li.is('.sub-menu li')){
            li.removeClass('current-menu-parent current-menu-item');
            e.preventDefault();
        }

        else if(!li.is('.sub-menu li')){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item');
        }

        else if(li.is('.sub-menu li')){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item').parents('li').addClass('current-menu-parent');
            e.preventDefault();
        }

    });
});
