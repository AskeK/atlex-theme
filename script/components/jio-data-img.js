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
            $imgID = $img.attr('data-img-id'),

            $imgIDSize = $img.attr('data-id-size'),
            $imgSrcset = $img.attr('data-srcset'),
            $imgSizes = $img.attr('data-sizes'),
            $imgPlaceholder = new Image();

        $img.removeAttr('data-src data-bg data-srcset data-sizes data-img-id data-id-size');

        if (typeof $imgSrc !== 'undefined') {
            $imgPlaceholder.src = $imgSrc;
            $imgPlaceholder.onload = function() {
                $img.removeClass('loading').attr('src', $imgSrc);
            };
        };

        if (typeof $imgID !== 'undefined' && typeof jsonURL !== 'undefined') {
            if(typeof $imgIDSize === 'undefined'){$imgIDSize = 'full';}

            jsGetJSON('media/'+$imgID, function(ret){

                if(ret.status === 404){
                    $img.parent('.image-container').remove();
                    $img.remove();
                }

                if (ret.status !== 404){

                    var imgsrc;
                    if(typeof ret.media_details.sizes[$imgIDSize] !== 'undefined'){
                        imgsrc = ret.media_details.sizes[$imgIDSize].source_url;
                    }

                    else{
                        imgsrc = ret.source_url;
                    }


                    $imgPlaceholder.src = imgsrc;
                    $imgPlaceholder.onload = function() {
                        $img.removeClass('loading').attr('src', imgsrc);
                    };
                };
            });
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
        $('[data-src], [data-bg], [data-srcset], [data-sizes], [data-img-id]').each(function(e){
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
