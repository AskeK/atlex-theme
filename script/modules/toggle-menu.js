$(function(){
    $('.site-header-hamburger').click(function(e){
        e.preventDefault();
        $('body').toggleClass('menu-open');
    });
});
