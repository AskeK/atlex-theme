$(window).on('formReturn',function(e){
    var t = $(e.target);

    if(t.is('.registration-form')){
        if(typeof e.response.error !== 'undefined'){
            if(!t.find('.error-span').length){
                var span = $('<span class="error-span"></span>');
                span.prependTo(t);
            }
            $('.error-span').html(e.response.error);
        }

        else{
            window.location.reload();
        }
    }
});
