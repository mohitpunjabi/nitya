$(function() {
    $('.navbar-sticky').stickyNav();

    $('.select2').select2();

    if(isTouchDevice()) $('.show-on-hover').css('opacity', 1);

    $('.magnify').carousel();

    $('.paginate-col').height($(window).height());

    $('.enquiry-form').hide();

    $('#sendEnquiryBtn').click(showEnquiry);
    $('#cancelEnquiryBtn').click(hideEnquiry);
    if(window.location.hash == '#enquire') showEnquiry();
});

function showEnquiry(e) {
    var animTime = 150;
    if(e) e.preventDefault();
    else  animTime = 1;
    $('.product-details').animate({
        opacity: 0,
        top: '-=100'
    }, animTime, function() {
        $(this).hide();
        $('.enquiry-form').css({
            display: 'block',
            opacity: '0',
            top: '100px'
        }).animate({
            opacity: 1,
            top: '0'
        }, animTime);
        $(window).scrollTop($('#enquire').offset().top - 200);
    });
}

function hideEnquiry(e) {
    var animTime = 150;
    if(e) e.preventDefault();
    else  animTime = 1;
    $('.enquiry-form').animate({
        opacity: 0,
        top: '+=100'
    }, animTime, function() {
        $(this).hide();
        $('.product-details').css({
            display: 'block',
            opacity: '0'
        }).animate({
            opacity: 1,
            top: '0'
        }, animTime);
    });
}

$(function() {
    var $loadMoreButton = $('.btn-load-more');
    var $window = $(window);

    function loadMoreProducts() {
        var $loadMoreButton = $('.btn-load-more');
        if($loadMoreButton.length > 0 && !$loadMoreButton.hasClass('disabled')) {
            $loadMoreButton.button('loading');
            $.ajax({
                type: 'GET',
                url: $loadMoreButton.attr('href'),
                data: {responseType: 'JSON'},
                success: function (data) {
                    var $productsGrid = $('.product-grid');
                    data.data.forEach(function (product) {
                        var $newCol = $('<div class="col-md-3 col-sm-6"></div>').append(product);
                        $newCol.hide().appendTo($productsGrid).fadeIn(300);
                    });
                    console.log(data.nextPageUrl);
                    if (!data.nextPageUrl) {
                        $loadMoreButton.attr('href', url('more'));
                        $loadMoreButton.removeClass('btn-load-more');
                    }
                    else $loadMoreButton.attr('href', data.nextPageUrl);

                    $loadMoreButton.button('reset');
                }
            });
        }
    }

    if($loadMoreButton.length) {
        $('body').on('click', '.btn-load-more', function(e) {
            loadMoreProducts();
            e.preventDefault();
        });

        $window.scroll(function() {
            if($window.scrollTop() > $loadMoreButton.offset().top - $window.height() - 200) {
                loadMoreProducts();
            }
        });
    }

});