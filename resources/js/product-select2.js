(function($) {
    $.productSelect2 = function(element, options) {
        var $element = $(element);
        var plugin = this;
        plugin.settings = {};

        var defaults = {
            multiple: true,
            placeholder: 'Select products',
            notInCatalogue: undefined
        };

        plugin.init = function() {
            plugin.settings = $.extend({}, defaults, options);

            $element.select2({
                ajax: {
                    url: url("products/search"),
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                minimumInputLength: 3,
                templateResult: formatProduct,
                templateSelection: formatProductSelection,
                placeholder: plugin.settings.placeholder,
                multiple: plugin.settings.multiple
            });
        };


        var formatProduct = function(product) {
            console.log(product);
            if(product.loading) {
                return 'Searching...';
            }
            var $available = '';
            if(!product.available) $available = '<span class="label label-warning">Unavailable</span> ';

            var $catalogues = '';
            if(product.catalogues) {
                $catalogues = '<div>';
                for(var i = 0; i < product.catalogues.length; i++)
                    $catalogues += '<span class="label label-default">' + product.catalogues[i].name + '</span> ';
                $catalogues += '</div>';
            }

            return $(
                '<div class="clearfix">' +
                '<div class="col-sm-2">' +
                '<img class="img img-responsive" src="' + url('img/sm/' + product.images[0].name) + '"/>' +
                '</div>' +
                '<div class="col-sm-10">' +
                $catalogues +
                '<div class="text-uppercase">' + $available + '<strong>' + product.name +'</strong></div>' +
                '<div class="text-overflow small">' + product.description + '</div>' +
                '<span class="text-muted small">ID ' + product.design_no + '</span>' +
                '</div>' +
                '</div>'
            );
        };

        var formatProductSelection = function(product) {
            if (product.loading) {
                return 'Searching...';
            }

            return $(
                '<span><img width="90" class="img img-responsive" src="' + url('img/sm/' + product.images[0].name) + '"/></span>' +
                '<div style="max-width: 85px" class="text-overflow text-uppercase small"><strong>' + product.name + '</strong></div>' +
                '<small class="text-muted">ID ' + product.design_no + '</small>'
            );
        };

        plugin.init();
    };

    // add the plugin to the jQuery.fn object
    $.fn.productSelect2 = function(options) {
        return this.each(function() {
            if (undefined == $(this).data('productSelect2')) {
                var plugin = new $.productSelect2(this, options);
                $(this).data('productSelect2', plugin);
            }
        });
    }

})(jQuery);