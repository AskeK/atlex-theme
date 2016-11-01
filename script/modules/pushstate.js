function addPush(object, type){
        var pushUrl = object.attr('data-href'),
            pushName = object.attr('title'),
            pushID = object.attr('id').replace('post_','');

        if(!pushUrl){
            pushUrl = object.attr('href');
        }

        history.pushState({url : pushUrl, name: pushName, ID: pushID, type: type}, pushID, pushUrl);
        document.title = pushName + ' · Faaborg Gymnasium';
}

function resetOldPush(){
            // Flyt gammel artikel tilbage, hvis den findes
            var prev = $('.reading');
            if(prev.length){
                prev.removeClass('reading');
                /*
                var order  = prev.data('post-order');
                var before = $('[data-post-order="'+(order -1)+'"]');

                prevHr = prev.next('hr');
                prev.insertAfter(before);
                prevHr.insertAfter(before);
                */
            }


}

function setPopstateReading(elem){

    // elem.next('hr').prependTo('.post-list');

    elem.addClass('reading');//


    if(elem.hasClass('mb-entry') || $('body').hasClass('single-nyt') || $('body').hasClass('archive-nyt')){

        elem.next('hr').prependTo('.post-list');
        elem.prependTo('.post-list');

    }


    $('html, body').delay(200).animate({scrollTop: elem.offset().top - $('#head').innerHeight()},200);

}


$(function(){


    window.onpopstate = function(event) {

        // Hvis popstate er tomt, genopfrisk siden
        if(!event.state){
            //location.reload();
        }

        // Hvis popstate type er 'nyt' eller 'medarbejder'
        else if(event.state.type === 'nyt' || event.state.type === 'medarbejder'){

            // Justér titel
            document.title = event.state.name + ' · Faaborg Gymnasium';


            resetOldPush(); // Fjern gammel artikel fra top
            setPopstateReading($('#post_'+event.state.ID)); // Tilføj ny artikel til top
        }
    };



    /* NYHEDSARKIV OG TEMA*/

    if($('.archive-entry.reading').length){


            $('.archive-entry.reading');//.next('hr').prependTo('.post-list');

            $('.archive-entry.reading');//.prependTo('.post-list');


         if($('body').hasClass('single-nyt') || $('body').hasClass('archive-nyt')){

                 $('.archive-entry.reading').next('hr').prependTo('.post-list');
                 $('.archive-entry.reading').prependTo('.post-list');

            }


            $('html, body').delay(200).animate({scrollTop: $('.archive-entry.reading').offset().top - $('#head').innerHeight()},200);

    }


    $('.archive-entry').click(function(e){
        if(!$('body').hasClass('post-type-archive-tema') && $(this).attr('id') !== 'content-add-btn' && $(this).attr('id') !== 'add-edit-content' && !$('body').hasClass('page') ){
        // Kun hvis ikke allerede vist
        if(!$(this).hasClass('reading')){

            resetOldPush(); // Fjern gammel artikel fra top
            addPush($(this),'nyt'); // tilføj pushstate til browser
            setPopstateReading($(this)); // Tilføj ny artikel til top
        }
        }
    });


    /* MEDARBEJDERE */

    if($('.mb-entry.reading').length){

        $('.mb-entry.reading').next('hr').prependTo('.post-list');

        $('.mb-entry.reading').prependTo('.post-list');

    }


    $('.mb-entry').click(function(e){

        // Kun hvis ikke allerede vist
        if(!$(this).hasClass('reading')){

            resetOldPush(); // Fjern gammel artikel fra top
            addPush($(this),'medarbejder'); // tilføj pushstate til browser
            setPopstateReading($(this)); // Tilføj ny artikel til top
        }
    });



    /* UNDERSIDER */

    $('.page .archive-entry').bind('click',function(){
        var path = $(this).attr('data-href');
        console.log(path);
        window.location = path;

    });
});
