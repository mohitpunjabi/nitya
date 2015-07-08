$(function() {
    $('.navbar').stickyNav();

    $('.select2').select2();

    if(isTouchDevice()) $('.show-on-hover').css('opacity', 1);

    $('.magnify').carousel();

    $('.paginate-col').height($(window).height());

    $('.enquiry-form').hide();

    $('#sendEnquiryBtn').click(function(e) {
        e.preventDefault();
        $('.product-details').animate({
            opacity: 0,
            top: '-=100'
        }, 150, function() {
            $(this).hide();
            $('.enquiry-form').css({
                display: 'block',
                opacity: '0',
                top: '100px'
            }).animate({
                opacity: 1,
                top: '0'
            });
        });
    });

    $('#cancelEnquiryBtn').click(function(e) {
        e.preventDefault();
        $('.enquiry-form').animate({
            opacity: 0,
            top: '+=100'
        }, 150, function() {
            $(this).hide();
            $('.product-details').css({
                display: 'block',
                opacity: '0'
            }).animate({
                opacity: 1,
                top: '0'
            });
        });
    });
});