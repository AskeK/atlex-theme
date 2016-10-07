var updatePop = function(id,val){

    $.ajax({
        url : ajaxURL,
        type : 'POST',
        data : {
            action : 'update_pop',
            post_id : id,
            value : val,
        },
        dataType : 'json',
        success : function(response){
        },
    });

}
