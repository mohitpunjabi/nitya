var isTouchDevice = function() {
    return 'ontouchstart' in window // works on most browsers
        || 'onmsgesturechange' in window; // works on ie10
};

(function($) {

    $.cImage = function(element, carousel) {
        var $element = $(element);
        var self = this;

        this.thumbnail = new Image();
        this.thumbnail.src = $element.data('thumbnail-src');
        this.thumbnail.loaded = false;
        this.thumbnail.onload = function() {
            self.thumbnail.loaded = true;
        };

        this.small = new Image();
        this.small.src = $element.data('small-src');
        this.small.loaded = false;
        this.small.onload = function() {
            self.small.loaded = true;
        };

        this.large = new Image();
        this.large.loaded = false;
        this.large.onload = function() {
            self.large.loaded = true;
        };

        this.link = $element.find('a');
        this.link.find('img').attr('src', this.thumbnail.src);

        this.link.click(function(e) {
            carousel.setCurrent(self);
            e.preventDefault();
        });

        this.isCurrent = function() {
          return $element.hasClass('current');
        };

        this.removeCurrent = function() {
            $element.removeClass('current');
        };

        this.setCurrent = function() {
            $element.addClass('current');
            this.large.src = $element.data('large-src');
        };

        if(this.isCurrent())
            this.large.src = $element.data('large-src');
    };

    $.carousel = function(element, options) {

        var plugin = this;

        var $element = $(element);
        var $images = $element.find('.thumbnails > .thumbnail');
        var $zoomButton = $element.find('.btn-zoom');

        plugin.settings = {};

        var defaults = {
            displayImage: $element.find('.display-image')
        };


        plugin.init = function() {
            plugin.settings = $.extend({}, defaults, options);

            plugin.cImages = [];
            $images.each(function() {
                plugin.cImages.push(new $.cImage(this, plugin));
            });

            plugin.currentImage = plugin.cImages.filter(function(value) {
                return value.isCurrent();
            })[0] || plugin.cImages[0];

            plugin.setCurrent(plugin.currentImage);
            if(!isTouchDevice()) {
                plugin.magnifier = new $.magnify($element, {
                    largeElem: $('#zoomView'),
                    smallElem: plugin.settings.displayImage,
                    largeImage: plugin.currentImage.large.src
                });
            }
        };

        // public methods
        plugin.setCurrent = function(cImage) {
            plugin.currentImage.removeCurrent();
            plugin.currentImage = cImage;
            cImage.setCurrent();
            plugin.settings.displayImage.attr('src', cImage.small.src);
            $zoomButton.attr('href', cImage.large.src);
            if(plugin.magnifier) plugin.magnifier.setImage(cImage.large.src);
        };

        // private methods

        plugin.init();
    };

    $.magnify = function(element, options) {

        var $element = $(element);

        var plugin = this;

        plugin.settings = {};

        var defaults = {
            largeElem: $element.find('.large'),
            smallElem: $element.find('.small'),
            largeImage: $element.find('.large').data('src')
        };

        plugin.init = function() {
            plugin.settings = $.extend({}, defaults, options);
            plugin.initVars();
            handleEvents();
        };

        // public methods
        plugin.initVars = function() {
            plugin.largeWidth = plugin.settings.largeElem.width();
            plugin.largeHeight = plugin.settings.largeElem.height();
            plugin.smallWidth = plugin.settings.smallElem.width();
            plugin.smallHeight = plugin.settings.smallElem.height();
            plugin.width = $element.width();
            plugin.height = $element.height();
            plugin.nativeWidth = 0;
            plugin.nativeHeight = 0;

            var img = new Image();
            img.onload = function() {
                plugin.nativeHeight = this.height;
                plugin.nativeWidth = this.width;

                plugin.ratioX = plugin.nativeWidth / plugin.smallWidth;
                plugin.ratioY = plugin.nativeHeight / plugin.smallHeight;
            };
            img.src = plugin.settings.largeImage;
            plugin.settings.largeElem.css('background-image', "url('" + img.src + "')");
        };

        plugin.setImage = function(image) {
            plugin.settings.largeImage = image;
            plugin.initVars();
        };

        // private methods
        var isPointInside = function(mx, my) {
            return mx < plugin.width && my < plugin.height && mx > 0 && my > 0;
        };

        var isLargeImageLoaded = function() {
            return plugin.nativeWidth > 0  && plugin.nativeHeight > 0;
        };

        var adjustBackgroundPositionTo = function(mx, my) {
            var pad = plugin.largeHeight/2;
            var rx = -Math.round(mx * plugin.ratioX - pad);
            var ry = -Math.round(my * plugin.ratioY - pad);

            rx = Math.max(Math.min(0, rx), plugin.largeWidth - plugin.nativeWidth);
            ry = Math.max(Math.min(0, ry), plugin.largeHeight - plugin.nativeHeight);
            var bgp = rx + "px " + ry + "px";

            plugin.settings.largeElem.css({backgroundPosition: bgp});
        };

        var showLarge = function() {
            plugin.settings.largeElem.fadeIn(100);
        };

        var hideLarge = function() {
            plugin.settings.largeElem.fadeOut(100);
        };
        var showZoomView = function(e) {
            if(isLargeImageLoaded()) {
                var magnify_offset = $element.offset();
                var mx = e.pageX - magnify_offset.left;
                var my = e.pageY - magnify_offset.top;

                if (isPointInside(mx, my))  showLarge();
                else                        hideLarge();

                if(plugin.settings.largeElem.is(":visible")) {
                    adjustBackgroundPositionTo(mx, my);
                }
            }
        };

        var handleEvents = function() {
            $(document).mousemove(showZoomView);
            $(window).resize(plugin.initVars);
        };

        plugin.init();
    };

    // add the plugin to the jQuery.fn object
    $.fn.carousel = function(options) {
        return this.each(function() {
            if (undefined == $(this).data('carousel')) {
                var plugin = new $.carousel(this, options);
                $(this).data('carousel', plugin);
            }
        });
    }

})(jQuery);