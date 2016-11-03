// Refreshtoken: 1/XsKB2xh_rvd_ci2aRgIMjAOrgYImfr7x_SDpx_1w610

// Video handler function
var YT_GetAccessToken = function(clientID, clientSecret, refreshToken, callback) {
    var xhr = new XMLHttpRequest();
    xhr.addEventListener("load", function() {
        if (typeof callback === "function") {
            callback( clientID, clientSecret, JSON.parse( xhr.response ).access_token );
        }
    });

    xhr.open( 'POST', 'https://www.googleapis.com/oauth2/v4/token' );
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var request = "client_id=" + clientID + "&client_secret=" + clientSecret + "&refresh_token=" + refreshToken + "&grant_type=refresh_token";
    xhr.send(request);

}

var YT_UploadVideo = function(file, clientID, clientSecret, accesstoken, params) {
    if ( file != undefined ) {
        var uploadStartTime;
        var callback, progress, error, meta;
        if (typeof params === "object") {
            callback = params.callback || "noop";
            progress = params.progress || "noop";
            error = params.error || "noop";
            meta = params.meta ||
            {
                "snippet": {
                    "title": 'Atlex video',
                    "description": 'Atlex',
                    "tags": ["test"],
                    "categoryId": 22,
                },
                "status": {
                    "privacyStatus": 'unlisted',
                },
            }
        }

        // Creates object used to upload file
        var uploader = new MediaUploader({
            "baseUrl": 'https://www.googleapis.com/upload/youtube/v3/videos',
            "file": file,
            "token": accesstoken,
            "metadata": meta,
            "params": {
                "part": 'snippet,status',
            },

            // Error message
            onError: function() {
                document.getElementById("video-statustext").innerHTML = "( Upload afbrudt pågrund af fejl )";
                if (typeof error === "function") {
                    error();
                }
            },

            // Loading "bar"
            onProgress: function(data) {
                var timePassed = (new Date()).getTime() - uploadStartTime;
                if (typeof progress === "function") {
                    progress(data, timePassed);
                }
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
        uploadStartTime = (new Date()).getTime();
        uploader.upload();
    }
}

// Delete video
var YT_DeleteVideo = function(videoID, clientID, clientSecret, accessToken, callback) {

    var xhr = new XMLHttpRequest();
    xhr.open('DELETE', 'https://www.googleapis.com/youtube/v3/videos' );
    if (typeof callback === "function") {
        xhr.addEventListener("load", callback());
    }

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("Authorization", "Bearer " + accessToken);
    var request = "client_id=" + clientID + "&client_secret=" + clientSecret
        + "&scope=https://www.googleapis.com/auth/youtube&id=" + videoID;

    xhr.send(request);

}

// Construct videohandler, init vars
var videoUploadBtn = document.getElementById("video-upload-btn");
if(null !== videoUploadBtn){
    videoUploadBtn.addEventListener('click', function() {
        if(!$('.ovelse-form').find('input[name="video-id"]').length){
            YT_GetAccessToken(
                '277088904091-9i70tiqg90t53ev4mu3j6dlfel4ie1h9.apps.googleusercontent.com',
                '4DwvzFwbw4vVrrrxbO0w_rE_',
                '1/XsKB2xh_rvd_ci2aRgIMjAOrgYImfr7x_SDpx_1w610',
                function(clientID, clientSecret, accesstoken) {
                    YT_UploadVideo(
                        document.getElementById("video-file").files[0],
                        clientID, clientSecret, accesstoken,
                        {
                            "callback": function(r){
                                $('.ovelse-form').prepend('<input type="hidden" name="video-id" value="'+r+'"/>');
                                $('.video-preview iframe').attr('src','https://youtube.com/embed/' + r);
                                $('.video-upload').addClass('has-video');
                            },
                            "progress": function(data, timePassed) {
                                if (timePassed / 1000 > 2.5) {
                                    var estimatedTime = Math.floor( ((data.total - data.loaded) / data.loaded) * timePassed );
                                    var formatted = Math.floor( estimatedTime / 1000 / 60 ) + " min "
                                        + Math.floor( (estimatedTime / 1000) % 60 ) + " sek";
                                    document.getElementById("video-statustext").innerHTML = "( " + formatted + " )";
                                } else {
                                    document.getElementById("video-statustext").innerHTML
                                        = "( Calculating estimated time remaining )"
                                }
                            }
                        }
                    );
                }
            );
        }
    });
}

// Remove that video
$('.video-preview-delete').on('click',function(e){

    var videoid = $('input[name="video-id"]')[0].getAttribute("value");
    YT_GetAccessToken(
        '277088904091-9i70tiqg90t53ev4mu3j6dlfel4ie1h9.apps.googleusercontent.com',
        '4DwvzFwbw4vVrrrxbO0w_rE_',
        '1/XsKB2xh_rvd_ci2aRgIMjAOrgYImfr7x_SDpx_1w610',
        function(clientID, clientSecret, accessToken) {
            YT_DeleteVideo(videoid, clientID, clientSecret, accessToken, function() {});
        }
    );

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
