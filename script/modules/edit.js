$(function(e){
    // Fortryd indtastning og vend tilbage til forløb
    $('.clear-ovelse-form').on('click',function(e){
        e.preventDefault();
        var form = $('.ovelse-form');
        articlePageToggle('1','forlob-add-ovelse');
        clearForm(form);
    });

    // Gem øvelse til forlob
    $('.wp-save-to-forlob').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');

        if(validateForm(form)){

            form.addClass('loading');
            var formData = form.serialize(),
                action = form.attr('action');

            formData += '&draft=draft';

            $.ajax({
                url : action,
                type : 'POST',
                data : formData,
                dataType : 'json',
                success : function(response){



                    // indsæt i select og opret klon med tilvalg
                    var id = response.post_id;
                    jsRenderModule({
                        endpoint : 'ovelse/' + id,
                        target : '.attach-ovelse-list',
                        overwrite : false,
                        template : 'jsTemplate-attach-ovelse',

                    },function(){
                        var elem = $('#attach-ovelse-list .ovelse-item-'+id);

                        var offset = elem.offset().top,
                            pageOffset = $(window).innerHeight() - elem.innerHeight() - 30;

                        console.log(offset,pageOffset,offset - pageOffset);
                        $('html,body').animate({scrollTop : offset - pageOffset},200);

                        setAttachInputNames();

                        // ryd form og vend tilbage
                        form.removeClass('loading');
                        clearForm(form);
                        articlePageToggle('1','forlob-add-ovelse');

                        setTimeout(function(){
                            elem.addClass('blink-out');
                        },200);

                        setTimeout(function(){
                            elem.removeClass('blink-out blink');
                        },800);
                    });
                },
            });
        }
    });
});

$(window).on('formReturn',function(e){
    if(e.response.post_status === 'publish'){
        window.location.href = ajaxURL.replace('wp-admin/admin-ajax.php','?p='+e.response.post_id);
    }
});
