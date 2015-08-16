(function($) {
    $.productSelect2 = function(element, options) {
        var $element = $(element);
        var plugin = this;
        plugin.settings = {};

        var defaults = {
            multiple: true,
            placeholder: 'Select products',
            thumbnailSize: 85,
            notInCatalogue: undefined,
            showCatalogues: true,
            mini: false,
            minimumInputLength: 1
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
                minimumInputLength: plugin.settings.minimumInputLength,
                templateResult: formatProduct,
                templateSelection: formatProductSelection,
                placeholder: plugin.settings.placeholder,
                multiple: plugin.settings.multiple
            });

            if(plugin.settings.mini) plugin.settings.thumbnailSize = 40;
        };


        var formatProduct = function(product) {
            if(product.loading) return 'Searching...';

            var $available = '';
            if(!plugin.settings.mini && !product.available) $available = '<span class="label label-warning">Unavailable</span> ';

            var $catalogues = '';
            if(!plugin.settings.mini && product.catalogues) {
                $catalogues = '<div>';
                for(var i = 0; i < product.catalogues.length; i++)
                    $catalogues += '<span class="label label-default">' + product.catalogues[i].name + '</span> ';
                $catalogues += '</div>';
            }

            var thumColWidth = (plugin.settings.mini)? 3: 2;
            return $(
                '<div class="clearfix">' +
                '<div class="col-sm-' + thumColWidth + '">' +
                '<img class="img img-responsive" src="' + url('img/sm/' + product.images[0].name) + '"/>' +
                '</div>' +
                '<div class="col-sm-' + (12 - thumColWidth) + '">' +
                $catalogues +
                '<div class="text-uppercase">' + $available + '<strong>' + product.name +'</strong></div>' +
                '<div class="text-overflow small">' + product.description + '</div>' +
                '<span class="text-muted small">ID ' + product.design_no + '</span>' +
                '</div>' +
                '</div>'
            );
        };

        var formatProductSelection = function(product) {
            if (product.loading) return 'Searching...';
            if (product.text) return product.text;

            if(plugin.settings.mini) {
                return $(
                    '<span><img height="30" src="' + url('img/sm/' + product.images[0].name) + '"/></span> ' +
                    '<strong>' + product.design_no + ':</strong> <span style="max-width: 150px" class="text-overflow text-uppercase small">' + product.name + '</span>'
                );
            }

            return $(
                '<span><img width="' + plugin.settings.thumbnailSize + '" class="img img-responsive" src="' + url('img/sm/' + product.images[0].name) + '"/></span>' +
                '<div style="max-width: ' + plugin.settings.thumbnailSize + 'px" class="text-overflow text-uppercase small"><strong>' + product.name + '</strong></div>' +
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