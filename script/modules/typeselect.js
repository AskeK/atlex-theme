// typeselect
function typeselect(f){
    var i = f.children('input[type="text"]'),
        h = f.children('input[type="hidden"]'),
        a = f.children('.input-btn'),
        l = f.children('ul');

    a.off().on('click',function(e){
        e.preventDefault();
        l.children('li').addClass('visible').removeClass('hidden');
        f.toggleClass('show-list').removeClass('invalid');
        l.children('.no-match').addClass('hidden').removeClass('visible');
    });

    l.off().on('click li',function(e){

        var t = $(e.target);
        if(!t.hasClass('no-match')){
            i.val(t.html());
            h.val(t.attr('data-option'))
            l.children('.selected').removeClass('selected');
            t.addClass('selected');
            f.removeClass('show-list');
        }
    });



    i.off().on('keyup',function(e){

        if (e.which === 13 || e.which === 32){

        }

        else if(e.which === 38){
            e.preventDefault();
            var sel = l.children('li.selected');
            if(sel.length){
                sel.removeClass('selected');
                var prv = sel.prevAll('.visible').first();
                if(prv.length ){
                    prv.addClass('selected');
                }
                else{
                    l.children('.visible').last().addClass('selected');
                }

            }
            else{
                l.children('li.visible').last().addClass('selected');
            }
        }
        else if(e.which === 40){
            e.preventDefault();
            var sel = l.children('li.selected');
            if(sel.length){
                sel.removeClass('selected');
                var nx = sel.nextAll('.visible').first();
                if(nx.length ){
                    nx.addClass('selected');
                }
                else{
                    l.children('.visible').first().addClass('selected');
                }

            }
            else{
                l.children('li.visible').first().addClass('selected');
            }

        }

        else{
            var str = i.val();
            if(str.length > 0){
                l.children('.selected').removeClass('selected');
                f.addClass('show-list').removeClass('invalid');
                l.children('.no-match').addClass('hidden').removeClass('visible');
                var count = 0;
                l.children('li').each(function(e){
                    if($(this).html().toLowerCase().indexOf(str.toLocaleLowerCase() || $(this).hasClass('no-match')) < 0){
                        $(this).addClass('hidden').removeClass('visible');
                    }
                    else{
                        $(this).addClass('visible').removeClass('hidden');
                        count ++;
                    }
                });
                if (count < 1){
                    l.children('.no-match').addClass('visible').removeClass('hidden');
                }

            }
            else{f.removeClass('show-list');}
        }
    });

    i.on('keydown',function(e){
        if (e.which === 13 || e.which === 32){
            e.preventDefault();
            var sel = l.children('li.selected');
            if(sel.length){
                i.val(sel.html());
                h.val(sel.attr('data-option'))
                f.removeClass('show-list');
            }
        }
    });

    i.on('blur',function(){
        f.removeClass('show-list');
        var str = i.val(),
            count = 0;
        l.children('li').each(function(){
            if(!$(this).hasClass('no-match') && $(this).html() === str){
                count ++;

            }
        });
        if (count < 1){
            f.addClass('invalid');
        }
    });
}

$(function(){
    $('fieldset.typeselect').each(function(){
        typeselect($(this));
    });

});
