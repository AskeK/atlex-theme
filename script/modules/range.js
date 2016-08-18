var rangeInput = function(e){
    var input = $(e.target),
        val = input.val(),
        fieldset = input.parent('fieldset'),
        label = fieldset.find('label'),
        output = fieldset.find('output');

    // Steps
    if(fieldset.is('.range-step')){

        var postfix = (fieldset.attr('data-steps') !== undefined) ? fieldset.attr('data-steps').split(';') : ['Nej','Ja'],
        fix,
        step = 100 / postfix.length;

        for (var i = 0, len = postfix.length; i < len; i++) {
            var k = step * i;

            if(val > k ){
                fix = postfix[i];
            }
        }

        output.html(fix);
    }

    // Tæller
    else if(fieldset.is('.range-postfix')){
        var postfix = ( fieldset.attr('data-postfix') !== undefined ) ? fieldset.attr('data-postfix').split(';') : [''],
            fix;

        if(val == 1){
            fix = postfix[0];
        }

        else if (postfix[1] !== undefined){
            fix = postfix[1];
        }

        else{
            fix = postfix[0];
        }

        output.html(val + ' ' + fix);

    }
}

var rangeChange = function(e){
    var input = $(e.target),
        val = input.val(),
        fieldset = input.parent('fieldset'),
        label = fieldset.find('label'),
        output = fieldset.find('output');

    if(fieldset.is('.range-step')){

        var postfix = (fieldset.attr('data-steps') !== undefined) ? fieldset.attr('data-steps').split(';') : ['Nej','Ja'],
        step = 100 / postfix.length,
        end;

        for (var i = 0; i < postfix.length; i++) {
            var k = step * i;

            if(val > k ){
                end = k + ( step / 2 );
            }
        }

    }
}

var rangeInit = function(){

    $('fieldset.range input').on({
        'input' : function(e){
            rangeInput(e);
        },
        'change' : function(e){
            rangeChange(e);
        },

    });
}

$(function(){
    rangeInit();
});
