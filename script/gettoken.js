$(function(){
    if($('section#video-upload').length){
        $.ajax({
            url : ajaxURL,
            type : 'POST',
            data : {
                action : 'get_google_api_token',
            },
            dataType : 'json',
            success : function(response){
                var token = response.token;

            },
        });
    }
});
