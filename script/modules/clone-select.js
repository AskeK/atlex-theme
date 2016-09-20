var cloneSelect = function(){

    $('.select-clone').each(function(){

        var span = $(this),
            select = span.find('select');
            add = span.find('a.clone-add'),
            remove = span.find('a.clone-remove');


        // klik på tilføj
        add.off().on('click',function(e){
            e.preventDefault();

            if(select.children('option:selected').val() !== '0' && span.is(':last-child')){
                span.clone().appendTo(span.parents('fieldset'));
                cloneSelect();
            }


        });

        //klik på fjern
        remove.off().on('click',function(e){
            e.preventDefault();
            if(!span.is(':first-child')){
                span.remove();
            }
        });
    });

}

$(function(){
    cloneSelect();
});
