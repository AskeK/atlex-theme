$.fn.randomize = function(selector){
  var $elems = selector ? $(this).find(selector) : $(this).children();
  for (var i = $elems.length; i >= 0; i--) {
    $(this).append($elems[Math.random() * i | 0]);
  }

  return this;
}

$(function(){
    var timing = 100;

    $('body').on('click','.article-page-header',function(e){
        e.preventDefault();
        var t = $(e.target),
            a = t.parent('a');
            header = t.parents('.article-page-header'),
            page = header.parents('.article-page');

        if(t.is('.order-by-rand, .order-by-rand *')){
            page.children('article').fadeOut(timing);
            setTimeout(function(){
                page.randomize('article');
                page.children('article').fadeIn(timing);
            },timing);
        }

        if(t.is('.order-by-pop, .order-by-pop *')){

            page.children('article').fadeOut(timing);
            setTimeout(function(){
                page.children('article').tsort({attr: 'data-p', order:'desc'}).fadeIn(timing);
            },timing);
        }

        if(t.is('.add-new, .add-new *')){
            var loc = $('.site-header-menu .login-link').attr('href');
            if(a.attr('href') !== '#' && typeof a.attr('href') !== 'undefined'){
                loc = a.attr('href');
            }

            else if(typeof current_user !== 'undefined'){

                loc += '/edit/';

                if(header.hasClass('article-page-header-forlob')){
                    loc += 'forlob/';
                }

                else{
                    loc += 'ovelse/';
                }
            }

            window.location.href = loc;
        }
    });
});
