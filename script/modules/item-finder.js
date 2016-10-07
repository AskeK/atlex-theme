var itemFinderslug = 'false',
    itemFinderTime = 0,
    itemFinderRanges = [],
    itemFinderType = 'ovelse';

$(function(){

    $('body').on('change','.item-finder-ranges input',function(e){

        $('.item-finder-toggle').removeClass('active');
        $('.toggle-ovelse').addClass('active');
        itemFinderType = 'ovelse';
        articlePageToggle(1,'top');

        var t = $(e.target),
            id = t.attr('data-term-id'),
            on = false;

        if(t.attr('data-meta') === 'time'){
            itemFinderTime = t.val();
            console.log(itemFinderTime);
        }

        if (parseInt(t.val()) > 49 && typeof id !== 'undefined'){
            itemFinderRanges.push(id);
        }

        else{
            itemFinderRanges.pop(id);
        }



        $('.article-page-ovelse article').each(function(){
            var s = $(this).attr('data-s').split(','),
                time = $(this).attr('data-t');

            var show = true;

            if (itemFinderRanges.length) {

                for (var i = 0; i < itemFinderRanges.length; i++) {
                    if(s.indexOf(itemFinderRanges[i]) < 0){
                        show = false;
                    }
                }
            }

            if(typeof time !== 'undefinded' && parseInt(time) < parseInt(itemFinderTime)){
                show = false;
            }

            if(show){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        });
    });

    $('body').on('click', '.item-finder-list-nav', function(e){

        $('.item-finder-toggle').removeClass('active');
        $('.toggle-ovelse').addClass('active');
        itemFinderType = 'ovelse';
        articlePageToggle(1,'top');
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
                target: '.main-section main .article-page-ovelse',
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
        $('body').removeClass('toggle-aside');
        $(this).addClass('active');


        itemFinderType = $(this).attr('data-type');

        var endpoint = itemFinderType;
        if(itemFinderslug !== 'false' && itemFinderType !== 'forlob'){
            endpoint += '/?filter[type]=' + itemFinderslug;
        }

        var articlePage = ('ovelse' === itemFinderType ? 1 : 2);
            articlePageToggle(articlePage,'top');


        if(!$('.article-page-'+itemFinderType+' article').length){
            $('.main-section main .article-page-'+itemFinderType).addClass('loading').css('height','400px');

            jsRenderModule({
                endpoint : endpoint,
                template: 'jsTemplate-article',
                target: '.main-section main .article-page-'+itemFinderType,
                overwrite: true,
                },function(){
                    $('.main-section main .article-page-'+itemFinderType).removeAttr('style');
                    jio_data_img.scan();
                }
            );
        }

    });
});
