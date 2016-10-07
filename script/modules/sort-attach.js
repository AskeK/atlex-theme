function setAttachInputNames(){

    $('#attach-ovelse-list li').each(function(i){
        var elem = $(this),
            input = elem.find('input[type="hidden"]');

        input.attr('name','attach_ovelse['+i+']');
    });
}

function sortAttach(parent){

    var elem = document.getElementById(parent);
    if(elem !== null){
        var sortable = Sortable.create(elem,{
            animation: 70,
            onUpdate: function () {
                setAttachInputNames();
            },

        });
    }
}



$(function(){
    sortAttach('attach-ovelse-list');

    $('body').on('click','.attach-ovelse-item .ovelse-delete',function(e){
        e.preventDefault();

        var parent = $(e.target).parents('li');
        parent.remove();
    });

    $('body').on('click','#forlob-add-ovelse .add-btn',function(e){

        e.preventDefault();
        var id = $('input[name="ovelse-picker-id"]').val(),
            typeselect = $(e.target).parents('fieldset.typeselect');

        if(id && typeof id !== 'undefined' && typeof typeselect !== 'undefined' && !typeselect.hasClass('invalid')){

            typeselect.addClass('loading');

            jsRenderModule({
                endpoint : 'ovelse/' + id,
                target : '.attach-ovelse-list',
                overwrite : false,
                template : 'jsTemplate-attach-ovelse',

            },function(){
                var elem = $('#attach-ovelse-list .ovelse-item-'+id);

                typeselect.removeClass('loading');

                var offset = elem.offset().top,
                    pageOffset = $(window).innerHeight() - elem.innerHeight() - 30;

                console.log(offset,pageOffset,offset - pageOffset);
                $('html,body').animate({scrollTop : offset - pageOffset},200);

                setAttachInputNames();

                setTimeout(function(){
                    elem.addClass('blink-out');
                },200);

                setTimeout(function(){
                    elem.removeClass('blink-out blink');
                },800);
            });
        }
    });
});
