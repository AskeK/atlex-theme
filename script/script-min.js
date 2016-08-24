var jio_data_img = {

  // $img is in view (true | false)
  inview : function($img){
    var w = $(window);
    if(w.scrollTop() + w.height() <= $img.offset().top){ return false; }
    else if (w.scrollTop() >= $img.offset().top + $img.height()){ return false; }
    else { return true; }
  },

  // placeholder load $img
  replace: function($img) {
    var $imgSrc = $img.attr('data-src'),
      $imgBg = $img.attr('data-bg'),
      $imgSrcset = $img.attr('data-srcset'),
      $imgSizes = $img.attr('data-sizes'),
      $imgPlaceholder = new Image();

      $img.removeAttr('data-src data-bg data-srcset data-sizes');

    if (typeof $imgSrc !== 'undefined') {
      $imgPlaceholder.src = $imgSrc;
      $imgPlaceholder.onload = function() {
        $img.removeClass('loading').attr('src', $imgSrc);
      };
    };

    if (typeof $imgSrcset !== 'undefined') {
      $imgPlaceholder.srcset = $imgSrcset;
      $imgPlaceholder.sizes = $imgSizes;
      $imgPlaceholder.onload = function() {
        $img.removeClass('loading').attr('srcset', $imgSrcset).attr('sizes', $imgSizes);
      };
    }

    if (typeof $imgBg !== 'undefined') {
      $imgPlaceholder.src = $imgBg;
      $imgPlaceholder.onload = function() {
        $img.removeClass('loading').css({
          backgroundImage: 'url(' + $imgBg + ')',
        });
      };
    };
  },

  // scan DOM for replacable img srcses
  scan : function(){
    $('[data-src], [data-bg], [data-srcset], [data-sizes]').each(function(e){
      var $img = $(this);
      if(jio_data_img.inview($img)){
        jio_data_img.replace($img);
      }
    });
  },

  // Initiate on each event in array
  init : function(events){
    if ($.isArray(events)){
      events.forEach(function(event){
        $(window).on(event,function(){
          jio_data_img.scan();
        });
      });
    }
  }
}

// Lesgo!
jio_data_img.init(['load','scroll','resize']);


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


function listItem(obj){

}


/* Script compiled using codekit */


$(function(){if($('.fixed-aside').length){

    var lastScrollTop = 0,
        aside = $('.fixed-aside'),
        container = $('.main-section'),
        topBuffer = $('.site-header').innerHeight();


    $(window).on('scroll', function () {

        if($(window).width() > 960){



            if(container.offset().top + container.innerHeight() < $(window).scrollTop() + $(window).height()){
                aside.addClass('stop');
            }

            else{

                aside.removeClass('stop');
            }


            if(container.offset().top < $(window).scrollTop() + topBuffer){

                aside.addClass('fixed');

            }

            else{
                aside.removeClass('fixed');
            }


            var st = $(this).scrollTop(),
                diff = st - lastScrollTop,
                scrollStop = $(window).innerHeight() + $(window).scrollTop(),
                fancyHeight = aside.offset().top + aside.innerHeight(),
                asideAmount = aside.scrollTop() + diff;

            if(aside.hasClass('stop')){

            }

            else if(!aside.hasClass('stop')){

                aside.scrollTop(asideAmount);
            }

            else{
                aside.scrollTop(0);
            }

            lastScrollTop = st;

        }
    });



    $(window).load(function(){

        if(container.innerHeight() < aside.innerHeight()){

            container.css({
                minHeight: aside.innerHeight(),
            });

        }

    });
}});


var player;

function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length===11){
        return match[7];
    }else{
        return false;
    }
}

function onPlayerReady() {

    // bind events
    player.mute();
    player.playVideo();

}

if($('.home .video-container').length){

    var $ytplayer = $('#ytplayer'),
        $wrapper = $('.video-container');




    // Inject YouTube API script
    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


    function onYouTubePlayerAPIReady() {

        // create the global player from the specific iframe (#video)
        player = new YT.Player('ytplayer', {
            videoId: youtube_parser($ytplayer.attr('data-src')),
            modestbranding: 1,
            controls: 0,
            showinfo: 0,
            events: {
                // call this function when player is ready to use
                'onReady': onPlayerReady,
                'onStateChange' : function(e){

                    if (e.data === YT.PlayerState.PLAYING) {
                        $wrapper.addClass('playing');
                    }

                    if (e.data === YT.PlayerState.ENDED) {
                        player.playVideo();
                    }
                }
            }
        });

    }

}


$(function(){

    $('.item-finder-list-nav').click(function(e){
        e.preventDefault();

        var a = $(this),
            parent = a.parents('.item-finder-list'),
            ul = parent.find('ul'),
            active = ul.find('.active');

        if (a.is('.prev') && active.prev('li').length){
            active.removeClass('active').prev('li').addClass('active');


        }
        else if(!a.is('.prev') && active.next('li').length){
            active.removeClass('active').next('li').addClass('active');
        }
        else{
            return;
        }

    });

});


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


$(function(){

    $('.site-header-hamburger').click(function(e){
        e.preventDefault();
        $('body').toggleClass('menu-open');
    });


    $('.site-header-navs').on('click',function(e){
        $('body').removeClass('menu-open');
    });

});


$(function(){

    $('.js-menu li').on('click',function(e){

        var a = $(e.target),
            li = a.parent('li'),
            ul = li.parents('ul');


        if(li.is('.current-menu-parent, .current-menu-item') && !li.is('.sub-menu li')){
            li.removeClass('current-menu-parent current-menu-item');
            e.preventDefault();
        }

        else if(!li.is('.sub-menu li')){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item');
        }

        else if(li.is('.sub-menu li')){
            ul.find('li').removeClass('current-menu-item current-menu-parent');
            li.addClass('current-menu-item').parents('li').addClass('current-menu-parent');
            e.preventDefault();
        }

    });
});


