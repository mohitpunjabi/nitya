$.fn.extend({

    stickyNav: function() {
        var $navbar = $(this);
        var oldClasses = $navbar.attr('class');
        var newClasses = 'navbar navbar-sticky navbar-solid navbar-default navbar-fixed-top';
        var height = $navbar.height();

        function setNavbarClass() {
            var scroll = $(window).scrollTop();
            if(scroll > height) $navbar.attr('class', newClasses);
            else                $navbar.attr('class', oldClasses);

        };

        setNavbarClass();
        $(window).scroll(setNavbarClass);
        return $(this);
    }

});