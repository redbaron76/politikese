/*!
 * LoadNext, a jQuery plugin for PongoCMS v2
 * Version v0.1.1
 * http://pongoweb.it/
 *
 * Copyright (c) 2012 Fabio Fumis
 * Licensed under the MIT License: 
 * http://pongoweb.it/license
 */

(function($) {
	
	$.LoadNext = function(options) 
	{
		// default configuration properties
		var defaults = {
			container: '.ad-paginating',
			list_wrapper: 'tbody',
			pag_list: '.pagination',
			next: null,
			label: 'Load next',
			btn_class: 'btn',
			onClickNext: function() {},
			onLoadComplete: function() {},
		};

		var self = this;

		var opts = $.extend(defaults, options);

		// Hide paginator
		var $paginator = $(opts.pag_list).hide();

		// Get next link url
		var url = (opts.next) ?
					$(opts.next).attr('href') :
					$paginator.find('li').last().find('a').attr('href');

		// Get item wrapper
		var $wrapper = $(opts.container);

		// Create load button
		if(url) {
			var $button = $('<a />').addClass(opts.btn_class)
								.attr('href', url)
								.html(opts.label)
								// .appendTo($wrapper);
								.insertAfter($wrapper);

			$button.on('click', function(e) {
				e.preventDefault();
				opts.onClickNext.call(this);
				var self = this;
				var url = $(self).attr('href');

				$.get(url, null, function(data) {
					var response = $(data).find(opts.container).parents('form').children();

					var list_items = $(response[1]).find(opts.list_wrapper + ' > tr'); // table
					var next_url = $(response[2]).find('li').last().find('a').attr('href'); // ul

					$wrapper.find(opts.list_wrapper).append(list_items);
					if(next_url) {
						$button.attr('href', next_url);
						opts.onLoadComplete.call(self);
					} else {
						$button.remove();
					}
				});
			});
		}
	}

})(jQuery);