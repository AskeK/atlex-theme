function dropzoneInput(){
    $('fieldset.file-upload').each(function(){
        var fieldset = $(this),
            div = fieldset.find('.file-upload-dz'),
            url = div.attr('data-url'),
            form = fieldset.parents('form');

        var dz = div.dropzone({
            url : ajaxURL,
            maxFiles : div.attr('data-max'),
            acceptedFiles : 'image/*',
            thumbnailWidth : 140,
            thumbnailHeight : 130,
            addRemoveLinks : true,
            dictRemoveFile : 'x',
            sending : function(file, xhr, formData) {
                formData.append("action", "file_upload");
            },

            success : function(e,response){

                var id = response.files[0].id;

                $(e.previewElement).attr('data-id',id);

                if(div.hasClass('cover-photo')){

                    var fileInput = form.find('input[name="cover-photo"]');

                    if(!fileInput.length){

                        fileInput = $('<input type="hidden" name="coverphoto" id="image-'+id+'">');
                        form.prepend(fileInput);
                    }

                    fileInput.val(id);

                }
                else{
                    var fileInput = $('<input type="hidden" name="images[]" id="image-'+id+'" value="'+id+'">');
                    form.append(fileInput);
                }
            },

            removedfile : function(e){
                var preview = $(e.previewElement),
                    id = preview.attr('data-id');

                $('input#image-'+id).remove();
                        preview.remove();

                $.ajax({
                    url : ajaxURL,
                    type : 'POST',
                    data : {
                        action : 'file_upload',
                        delete : id,
                    },
                    dataType : 'json',
                    success : function(response){},
                });
            }
        });
    });
}

$(function(){
    dropzoneInput();
});
