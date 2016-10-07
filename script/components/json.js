var jsonURL;
$(function(){
    jsonURL = $('link[rel="https://api.w.org/"]').attr('href') + 'wp/v2/';
});


function jsGetJSON(link,ret){
    $.ajax({
        url : jsonURL + link,
        type : 'GET',
        data : null,
        dataType : 'json',
        beforeSend: function ( xhr ) {
            xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
        },
        success : function(response){
            ret(response);
        },
    });
};

function jsGetPosts(query,ret){

    console.log('getting posts from ' + ajaxURL);

    query['action'] = 'get_posts';

    $.ajax({
        url : ajaxURL,
        type : 'POST',
        data : query,
        dataType : 'json',
        success : function(response){
            ret(response);
        },
    });

}
