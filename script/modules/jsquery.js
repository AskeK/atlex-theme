$(function(){

    $('jsquery').each(function(){

        var el = $(this),
            vars = {};

        el.each(function() {
          $.each(this.attributes, function() {
            if(this.specified) {
              vars[this.name] = this.value;
            }
          });
        });

        jsRenderModule(vars,vars.callback);

    });
});
