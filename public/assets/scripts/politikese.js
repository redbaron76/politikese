// var Politikese = {};

Politikese.UI = {

	init: function() {
		this.confirmDelete();
	},

	confirmDelete: function()
	{
		$('.pl-ask').on('click', function(e) {
			var resp = confirm("Eliminare il record?");
			if(resp) {
				return true;
			} else {
				e.preventDefault();
			}
		});
	},

};

Politikese.Selectize = {

	itemSelect: function(selector, value, label, items, api_url) {
		$(selector).selectize({
			delimiter: ',',
			valueField: value,
			labelField: label,
			searchField: [],
			maxOptions: items,
			onInitialize: function() {
				this.settings.searchField[0] = label;
			},
			create: function(input) {
				return {
					id: input,
					text: input
				}
			},
			render: {
				item: function(item, escape) {
					return '<div data-value="' + item[value] + '">' + escape(item[label]) + '</div>';
				},
				option: function(item, escape) {
					return '<div data-value="' + item[value] + '">' + escape(item[label]) + '</div>';
				},
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				var url = Politikese.Utils.url(api_url);
				$.post(url, {
					q: query
				}, function(res) {
					callback(res);
				});
			}
		});
	},

};

// Utils

Politikese.Utils = {

	/**
	 * Check if the browser is mobile
	 * @return {bool}
	 */
	mobileBrowser: function() {
		return (jQuery.browser.mobile) ? true : false;
	},

	/**
	 * Get current block Id
	 * @return {int}
	 */
	blockId: function() {
		var $input = $('input[name=current_block]');
		return ($input.length > 0) ? $input.val() : 0;
	},

	/**
	 * Get current page Id
	 * @return {int}
	 */
	pageId: function() {
		var $input = $('input[name=current_page]');
		return ($input.length > 0) ? $input.val() : 0;
	},

	/**
	 * Format a URL
	 * @param  string
	 * @return string
	 */
	site: function(uri) {
		return Politikese.site + uri;
	},

	/**
	 * Format a URL
	 * @param  string
	 * @return string
	 */
	url: function(uri) {
		return Politikese.base + '/' + uri;
	},

};

// init App
$(function() {

	Politikese.UI.init();

});

