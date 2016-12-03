(function ($, Drupal) {

    'use strict';

    Drupal.AjaxCommands.prototype.text = function (ajax, response, status) {
        var $wrapper = response.selector ? $(response.selector) : $(ajax.wrapper);
        var data = response.data;

        $wrapper.text(data);
    };

    Drupal.behaviors.nodeCount = {
        attach: function (context) {
            $('.node-stats', context).each(function (i, object) {
                var $stats = $(object);
                var url = '/ajax/node/' + $stats.attr('data-stats-nid') + '/view-count';
                var ajax = Drupal.ajax({
                    url: url
                });
                ajax.execute();
            });
        }
    };
}(jQuery, Drupal));