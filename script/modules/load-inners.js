function loadInners(article,target,callback){

    var ao = article.attr('data-a-o'),
        endpoint = 'ovelse/?filter[orderby]=post__in';

    if(ao.length){
        ao = ao.split(',');

        for (i = 0; i < ao.length; i++) {
            endpoint += '&filter[post__in][]='+ao[i];
        }

        jsRenderModule({
            endpoint : endpoint,
            template : 'jsTemplate-inner-article',
            target : target + ' .main-article',
            overwrite : false,
        },function(){

            if(typeof callback === 'function'){
                callback();
            }
        });
    }
}

$(function(){
    if($('body').hasClass('single-forlob')){
        var article = $('.main-article'),
            target = '.article-page-single',
            callback = null;

        loadInners(article, target ,callback);

    }
});
