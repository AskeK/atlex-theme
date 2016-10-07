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

            init : function(){

                var dz = this,
                    mockFile = {
                    name: "myimage.jpg",
                    size: 12345,
                    type: 'image/jpeg',
                    status: Dropzone.ADDED,

                    accepted: true,
                    mock : true,
                };

                if(div.hasClass('cover-photo')){

                    var coverphoto = form.find('input[name="coverphoto"]').attr('data-url'),
                        id = form.find('input[name="coverphoto"]').val();

                    if(typeof coverphoto !== 'undefined'){
                        div.addClass('dz-max-files-reached');
                        mockFile.url = coverphoto;
                        mockFile.id = id;

                        dz.emit("addedfile", mockFile);
                        dz.emit("complete", mockFile);
                        dz.emit("success", mockFile);
                        dz.emit("thumbnail", mockFile, coverphoto);

                        dz.files.push(mockFile);

                        form.find('input[name="coverphoto"]').removeAttr('data-url');

                    }
                }

                else{
                    var i = 0;
                    form.find('input[name="images[]"]').each(function(){

                        mockFile.url = $(this).attr('data-url') || undefined;
                        mockFile.id = $(this).val() || undefined;

                        if(typeof mockFile.url !== 'undefined' && typeof mockFile.url !== 'undefined' ){
                            i++;
                            dz.emit("addedfile", mockFile);
                            dz.emit("complete", mockFile);
                            dz.emit("success", mockFile);
                            dz.emit("thumbnail", mockFile, mockFile.url);

                            dz.files.push(mockFile);

                            $(this).removeAttr('data-url');
                        }

                        else{
                            $(this).remove();
                        }

                    });

                    if(i >= 4){
                        div.addClass('dz-max-files-reached');
                    }
                }
            },

            success : function(e,response){

                if(!e.mock){
                    var id = response.files[0].id;

                    $(e.previewElement).attr('data-id',id);

                    if(div.hasClass('cover-photo')){

                        var fileInput = form.find('input[name="coverphoto"]');

                        if(!fileInput.length){

                            fileInput = $('<input type="hidden" name="coverphoto" class="image-id" id="image-'+id+'">');
                            form.prepend(fileInput);
                        }

                        fileInput.val(id);

                    }
                    else{
                        var fileInput = $('<input type="hidden" name="images[]" class="image-id" id="image-'+id+'" value="'+id+'">');
                        form.append(fileInput);
                    }
                }
            },

            removedfile : function(e){

                var preview = $(e.previewElement),
                    id = preview.attr('data-id'),
                    dz = preview.parents('.file-upload-dz');

                if(typeof id === 'undefined'){id = e.id;}

                $('input#image-'+id).remove();
                preview.remove();
                dz.removeClass('dz-max-files-reached');

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
