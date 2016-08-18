$(function(){

    $('.item-finder-list-nav').click(function(e){
        e.preventDefault();

        var a = $(this),
            parent = a.parents('.item-finder-list'),
            ul = parent.find('ul'),
            active = ul.find('.active');

        if (a.is('.prev') && active.prev('li').length){
            active.removeClass('active').prev('li').addClass('active');


        }
        else if(!a.is('.prev') && active.next('li').length){
            active.removeClass('active').next('li').addClass('active');
        }
        else{
            return;
        }

    });

});
