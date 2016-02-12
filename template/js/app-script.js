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

    $('.add-to-cart').on('click', function(){
        var id = $(this).attr('data-id');

        $.post(
            '/cart/add/'+id,
            {},
            function(data) {
                console.log(data);
                $('.countProductsInCart').html(data);
            }
        );

        return false;
    });

    $('.add-to-cart-one').on('click', function(){
        var id = $(this).attr('data-id');
        var price = $('.app-product-price').html();

        $.post(
            '/cart/addProduct/'+id,
            {price: price},
            function(data) {
                var valueArray = data.split('|');

                $('.app-product-count').val(valueArray[0]);
                $('.app-product-amount').html(valueArray[1]);
            }
        );

        return false;
    });

    var price  = $('.app-product-price').html();
    var count  = $('.app-product-count').val();
    var amount = price * count;
    $('.app-product-amount').html(amount);

    ///////////////////////////////////////////////////////////////////////////
});
