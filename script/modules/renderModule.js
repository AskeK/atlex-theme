function jsRenderModule(vars, callback){

    $(vars.target).addClass('loading');

    jsGetJSON(vars.endpoint, function(response){

        if(response.status !== 404){

            var template = $.templates("#" + vars.template);

            var curpost = $('meta[name="post-id"]').attr('content');

            for (var i = 0; i < response.length; i++) {
                if(curpost == response[i].id){
                    response[i].isCurpost = true;
                }
            }

            var htmlOutput = template.render(response);

            if(typeof vars.overwrite === 'undefined' || vars.overwrite !== false ){
                $(vars.target).empty().html(htmlOutput).removeClass('loading');
            }

            else{
                $(vars.target).append(htmlOutput).removeClass('loading');
            }

            if(typeof callback === 'function'){


                callback();
            }
        }
    });
}

$.views.settings.allowCode(true);
