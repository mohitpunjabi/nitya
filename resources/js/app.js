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