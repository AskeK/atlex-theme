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
        success : function(response){
            ret(response);
        },
    });
};
