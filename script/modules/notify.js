
var notify = {
    send : function(options){
        var div = $('.site-notify');
        if(!div.length){
            div = $('<div class="site-notify hidden"></div>');
            $('body').append(div);
        }

        if(typeof options.message !== 'undefined'){
            div.append('<span>'+options.message+'</span>').removeClass('hidden').addClass('shown');

            if(typeof options.timeout !== 'undefined'){

                setTimeout(function(){
                    div.addClass('hidden');
                    setTimeout(function(){
                        div.removeClass('shown').empty();
                    },500);
                }, options.timeout * 1000);
            }
        }
    }
}
