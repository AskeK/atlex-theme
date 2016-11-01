var itemFinderslug = 'false',
    itemFinderTime = 0,
    itemFinderRanges = [],
    itemFinderType = 'ovelse';

$(function(){
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
                addHeader: true,
                },function(){
                    $('.main-section main .article-page-'+itemFinderType).removeAttr('style');
                    jio_data_img.scan();
                }
            );
        }

    });


    $('body').on('click', '.item-finder-list a', function(e){

        $('body').removeClass('toggle-aside');
        $('.item-finder-toggle').removeClass('active');
        $('.toggle-ovelse').addClass('active');
        itemFinderType = 'ovelse';
        articlePageToggle(1,'top');
        e.preventDefault();

        var a = $(this),
            parent = a.parents('.item-finder-list'),
            ul = parent.find('ul'),
            active = ul.find('.active'),
            li = a.parent('li'),
            itemFinderslug = li.attr('data-slug');

        active.addClass('trans').removeClass('active');
        li.addClass('active');

        var endpoint = itemFinderType;
        if (itemFinderslug !== 'false'){
            endpoint += '/?filter[type]=' + itemFinderslug;
        }

        jsRenderModule({
            endpoint : endpoint,
            template: 'jsTemplate-article',
            target: '.main-section main .article-page-ovelse',
            overwrite: true,
            addHeader: true,
            },function(){
                jio_data_img.scan();
            }
        );


    });

    /*
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
    */
    /*

    */
});
