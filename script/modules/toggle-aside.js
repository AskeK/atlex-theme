$(function(){

    $('.fixed-aside-toggle').on({

        'click' : function(e){
            e.preventDefault();
            $('body').toggleClass('toggle-aside');

        },

    });
});
