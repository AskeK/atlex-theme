$(function(){if($('.fixed-aside').length){

    var lastScrollTop = 0,
        aside = $('.fixed-aside'),
        container = $('.main-section'),
        topBuffer = $('.site-header').innerHeight();


    $(window).on('scroll', function () {

        if($(window).width() > 960){



            if(container.offset().top + container.innerHeight() < $(window).scrollTop() + $(window).height()){
                aside.addClass('stop');
            }

            else{

                aside.removeClass('stop');
            }


            if(container.offset().top < $(window).scrollTop() + topBuffer){

                aside.addClass('fixed');

            }

            else{
                aside.removeClass('fixed');
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

        }
    });



    $(window).load(function(){

        if(container.innerHeight() < aside.innerHeight()){

            container.css({
                minHeight: aside.innerHeight(),
            });

        }

    });
}});
