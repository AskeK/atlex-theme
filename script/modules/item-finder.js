$(function(){

    var itemFinderType = 'ovelse',
        itemFinderslug = 'false';

    $('body').on('click', '.item-finder-list-nav', function(e){
        e.preventDefault();

        var a = $(this),
            parent = a.parents('.item-finder-list'),
            ul = parent.find('ul'),
            active = ul.find('.active'),
            n;

        if (a.is('.prev') && active.prev('li').length){
            n = active.prev('li');
            itemFinderslug = n.attr('data-slug');

        }

        else if(!a.is('.prev') && active.next('li').length){
            n = active.next('li');
            itemFinderslug = n.attr('data-slug');
        }

        else{
            n = false;
        }

        if(n){

            active.removeClass('active');
            n.addClass('active');

            var endpoint = itemFinderType;
            if (itemFinderslug !== 'false'){
                endpoint += '/?filter[type]=' + itemFinderslug;
            }

            jsRenderModule({
                endpoint : endpoint,
                template: 'jsTemplate-article',
                target: '.main-section main',
                overwrite: true,
                },function(){
                    jio_data_img.scan();
                }
            );
        }

    });

    $('body').on('click', '.item-finder-toggle',function(e){
        e.preventDefault();
        $('.item-finder-toggle').removeClass('active');
        $(this).addClass('active');

        if(itemFinderType !== $(this).attr('data-type')){
            itemFinderType = $(this).attr('data-type');

            var endpoint = itemFinderType;
            if(itemFinderslug !== 'false' && itemFinderType !== 'forlob'){

                endpoint += '/?filter[type]=' + itemFinderslug;
            }

            jsRenderModule({
                endpoint : endpoint,
                template: 'jsTemplate-article',
                target: '.main-section main',
                overwrite: true,
                },function(){
                    jio_data_img.scan();
                }
            );
        }
    });
});
