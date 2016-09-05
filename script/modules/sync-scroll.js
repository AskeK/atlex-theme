$(function(){if($('.fixed-aside').length){

    var lastScrollTop = 0;


    $(window).on('scroll', function () {

        var aside = $('.fixed-aside'),
            container = $('.main-section'),
            topBuffer = $('.site-header').innerHeight();


        if(container.offset().top < $(window).scrollTop() + topBuffer){

            aside.addClass('fixed');

        }

        else{
            aside.removeClass('fixed');
        }

        if(container.offset().top + container.innerHeight() < $(window).scrollTop() + $(window).height()){
            aside.removeClass('fixed').addClass('stop');
        }

        else{

            aside.removeClass('stop');
        }


        var st = $(this).scrollTop(),
            diff = st - lastScrollTop,
            scrollStop = $(window).innerHeight() + $(window).scrollTop(),
            fancyHeight = aside.offset().top + aside.innerHeight(),
            asideAmount = aside.scrollTop() + diff;

        if(aside.hasClass('stop')){

        }

        else if(!aside.hasClass('stop')){

            aside.scrollTop(asideAmount);
        }

        else{
            aside.scrollTop(0);
        }

        lastScrollTop = st;


    });



    $(window).load(function(){
        if($('.fixed-aside .inner').innerHeight() > $(window).height()){
            $('.main-section').css({
                minHeight: $('.fixed-aside').innerHeight(),
            });
        }

    });
}});
