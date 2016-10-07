function dropzoneVideo(){
    $('fieldset.video-upload').each(function(){
        var fieldset = $(this),
            div = fieldset.find('.video-upload-dz'),
            url = div.attr('data-url'),
            form = fieldset.parents('form');

        var dz = div.dropzone({
            url : ajaxURL,
            maxFiles : div.attr('data-max'),
            acceptedFiles : '.mp4,.mkv,.avi,.mv4',
            addRemoveLinks : true,
            dictRemoveFile : 'x',
            sending : function(file, xhr, formData) {
                formData.append("action", "video_upload");
            }
        });
    });
}

$(function(){
  dropzoneVideo();
});
