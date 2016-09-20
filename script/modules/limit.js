var inputLimit = function(){
    $('input[maxlength], textarea[maxlength]').each(function(){
        var field = $(this),
            limit = field.attr('maxlength'),
            fieldset = field.parent('fieldset');

        if(fieldset.find('.maxlength-count').length === 0){
            var limitDiv = $('<div class="maxlength-count">'+limit+'</div>');
            field.parent('fieldset').append(limitDiv);
        }

        field.on('keyup',function(){
            var charnum = field.val().length,
                val = limit - charnum;

            if(val < 0){val = 0;}
            if(val < 11){ limitDiv.addClass('danger')}
            else{limitDiv.removeClass('danger')}

            limitDiv.html(val);
        });
    });

}

$(function(){
    inputLimit();
});
