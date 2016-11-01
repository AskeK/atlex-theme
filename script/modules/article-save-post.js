$(function(){

    $('body').on('click','.article-save-post input',function(e){

        if(!$('body').hasClass('logged-in')){
            var anchor = $('.login-link');
            if(anchor.length){
                window.location.href = anchor.attr('href');
            }
        }

        var checkbox = $(e.target),
            check = checkbox.context.checked,
            article = $(e.target).parents('article'),
            id = article.attr('id').replace('post-',''),
            saved_span = article.find('.article-saved-count span'),
            saved_value = saved_span.html(),
            check_span = article.find('.article-save-post');

        // iterer count
        if( !check ) {
            saved_value --;
            if ( saved_value < 0 ) { saved_value = 0; }
            article.removeClass('saved');
        }

        else{
            saved_value ++;
            article.addClass('saved');
        }

        saved_span.html( saved_value );

        // Opdater menu
        var menu_field = (article.hasClass('post-type-ovelse') ? $('.login-ovelse i') : $('.login-forlob i')),
            menu_field_val = parseInt(menu_field.html()),
            new_field_val = (check ? menu_field_val + 1 : menu_field_val - 1);

        menu_field.html(new_field_val);

        $.ajax({
            url : ajaxURL,
            type : 'POST',
            data : {
                action : 'save_user_meta',
                key : 'saved_posts',
                value : id,
                unique : false,
                remove : ( check ? false : true ),
            },
            dataType : 'json',
            success : function(response){


            },
        });
    });
});
