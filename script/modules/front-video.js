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
