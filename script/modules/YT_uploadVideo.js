// Video handler function
var YT_UploadVideo = function(file, clientID, clientSecret, refreshToken, callback) {
    if ( file != undefined ) {

        // Inits a http request to googles server
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("load", function() {

        // Get response from http request, including access token
        var resp = JSON.parse( xhr.response );

        // Metadata
        var metadata = {
            "snippet": {
                "title": 'Atlex video',
                "description": 'Atlex',
                "tags": ["test"],
                "categoryId": 22,
            },
            "status": {
                "privacyStatus": 'unlisted',
            },
        };

        // Creates object used to upload file
        var uploader = new MediaUploader({
                "baseUrl": 'https://www.googleapis.com/upload/youtube/v3/videos',
                "file": file,
                "token": resp.access_token,
                "metadata": metadata,
                "params": {
                "part": 'snippet,status',
            },

            // Error message
            onError: function() {
                document.getElementById("video-statustext").innerHTML = "( Upload afbrudt pågrund af fejl )";
            },

            // Loading "bar"
            onProgress: function(data) {
                document.getElementById("video-statustext").innerHTML = "( " + Math.floor(data.loaded / (data.total / 100)) + "% )";
            },

            // Upload complete message
            onComplete: function(data) {

                var videoID = JSON.parse( data ).id;

                document.getElementById("video-statustext").innerHTML = "( Upload færdig )";

                if(typeof callback === 'function'){
                    callback(videoID);
                }

            },
        });

        // Uploads file
        uploader.upload();

    });

          // Opens http request and sets encoding
          xhr.open( 'POST', 'https://www.googleapis.com/oauth2/v4/token' );
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

          // Sets request parameters (clientid, refreshtoken, etc.)
          var request = "client_id=" + clientID + "&client_secret=" + clientSecret + "&refresh_token=" + refreshToken + "&grant_type=refresh_token";

          // Runs the whole thing
          xhr.send(request);

        } else {

        // No file selected error message
        document.getElementById("video-statustext")
          .innerHTML = "( Ingen video valgt )";

    }
}

// Construct videohandler, init vars
var videoUploadBtn = document.getElementById("video-upload-btn");
if(null !== videoUploadBtn){
    videoUploadBtn.addEventListener('click', function() {
        if(!$('.ovelse-form').find('input[name="video-id"]').length){
            YT_UploadVideo(
                document.getElementById("video-file").files[0],
                '277088904091-9i70tiqg90t53ev4mu3j6dlfel4ie1h9.apps.googleusercontent.com',
                '4DwvzFwbw4vVrrrxbO0w_rE_',
                '1/BsQrj8Mbtbe48_KBObfskwYtUwesTS-xz75bZIPW5Q8',
                function(r){
                    $('.ovelse-form').prepend('<input type="hidden" name="video-id" value="'+r+'"/>');
                    $('.video-preview iframe').attr('src','https://youtube.com/embed/' + r);
                    $('.video-upload').addClass('has-video');
                }
            );
        }
    });
}
// Remove that video
$('.video-preview-delete').on('click',function(e){
    e.preventDefault();
    $('.video-upload').removeClass('has-video');
    $('input[name="video-id"]').remove();

    var post_id = $('input[name="post-id"]').val();

    if('0' !== post_id){

        $.ajax({
            url : ajaxURL,
            type : 'POST',
            data : {
                action : 'file_upload',
                delete : 'video-id',
                post_id : post_id,
            },

            dataType : 'json',
            success : function(response){

            },
        });

    }
});
