var jsonURL = $('link[rel="https://api.w.org/"]').attr('href') + 'wp/v2/';
function getJSON(link,ret){
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
