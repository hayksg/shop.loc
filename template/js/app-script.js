$(function(){
    if($(document).height() <= $(window).height()){
        $('footer').addClass('navbar-fixed-bottom');
    }

    ///////////////////////////////////////////////////////////////////////////

    $('.app-btn-orange').hover(
        function(){
            $(this).css({
                'background': '#f5f5ed',
                'color': '#696763',
            });
        },
        function(){
            $(this).css({
                'background': '#fe980f',
                'color': '#FFF',
            });
        }
    );

    ///////////////////////////////////////////////////////////////////////////
});
