var current_user;

$(function(){
    var user_meta = $('meta[name="user-id"]');

    if(user_meta.length){
        var user_id = user_meta.attr('content');
        user_meta.remove();

        jsGetJSON('users/'+user_id, function(response){

            current_user = response;
            console.log(response);
            $.views.helpers({
                current_user: current_user,
            });
        });

    }

    else{
        $.views.helpers({
            current_user: false,
        });
    }
});


