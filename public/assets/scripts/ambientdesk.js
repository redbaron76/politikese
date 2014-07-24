/**
 * Declared in virtual bootstrap.js
 *
 * AD = {};
 */

// User Interface

AD.UI = {

	// jQuery properties

	$body: $(document.body),
	$win: $(window),
	$wrapper: $('.wrapper'),
	$navbar: $('.navbar'),
	$overlay: $('.overlay'),
	$container: $('.container'),
	$alert_box: $('.alert-msg'),
	$breadcrumb: $('.breadcrumb-wrapper'),
	$btn_clicked: null,
	$box_checked: null,
	$box_status: null,
	$layout_radio: null,
	$modal: null,

	btn_text: null,
	lang: null,
	timeout: 1 * 1000,

	init: function() {
		this.addHover();
		this.loadingSpinner();
		this.loadingCheckbox();
		this.onCloseModal();
		this.alignTHead();
		this.windowResize(this.adjustModal());
	},

	addHover: function() {
		var $obj, item;
		$('.ad-hovering').on('mouseenter', '.ad-hover', function() {
			$obj = $(this);
			item = $obj.data('hover');
			$obj.children('*').hide();
			$obj.append(AD.Templates[item + '_tpl']);
		}).on('mouseleave', '.ad-hover', function() {
			$obj = $(this);
			$obj.find('.ad-hovertext').remove();
			$obj.children('*').show();
		});

	},

	/**
	 * Add or prepend spin icon class
	 */
	addSpin: function() {
		this.btn_text = this.$btn_clicked.html();
		if(!this.checkSpin()) {
			if(this.btn_text.indexOf('<i') == -1) {
				this.$btn_clicked.prepend(AD.Templates.loading_tpl);
			} else {
				this.$btn_clicked.find('i').removeClass().addClass('fa fa-refresh fa-spin');
			}
		}
	},

	addShake: function() {
		AD.Form.$form.addClass('shake');
	},

	hideModal: function() {
		if(this.$modal) {
			this.$modal.modal('hide');
		};
	},

	onCloseModal: function() {
		$('.modal').on('hidden.bs.modal', function (e) {
			AD.UI.resetBtn();
		})
	},

	createAlertMessage: function(data, textStatus, jqXHR) {
		this.$alert_box.remove();
		var msg = $('<div/>')
					.attr('class', 'alert-msg')
					.addClass(data.status)
					.html(data.msg);
		if(data.type == 'expired') {
			AD.Form.redirectTo('login');
		} else {
			this.$alert_box = msg;
			// Fix fixed position bug
			if(Modernizr.touch) {
				this.$alert_box.addClass('fixfixed');
				this.$body.animate({scrollTop: 0}, 0).prepend(msg);
			} else {
				this.$body.prepend(msg);
			}
		}
	},

	/**
	 * Check all elements to be copied
	 * @return {void}
	 */
	checkAllCopy: function() {
		$('#copy_all').change(function () {
			$('.copy_block').prop('checked', this.checked);
		});
	},

	/**
	 * Check if button clicked has spin
	 * 
	 * @return {bool}
	 */
	checkSpin: function() {
		return this.$btn_clicked.find('i').hasClass('fa-spin');
	},

	/**
	 * Check if checkbox clicked has spin
	 * 
	 * @return {bool}
	 */
	checkBoxSpin: function() {
		if ( ! this.$box_checked) return false;
		return this.$box_checked.next('i').hasClass('fa-spin');
	},

	checkEmptyList: function() {
		return (AD.Sortable.$item_list.children().html());
	},

	/**
	 * [getActivePageList description]
	 * @return {[type]} [description]
	 */
	activePageList: function() {
		return AD.Sortable.$page_list.filter('[rel=' + this.lang + ']');
	},

	/**
	 * Add spinning icon to button
	 * @return {[type]} [description]
	 */
	loadingSpinner: function() {
		var self = this;
		$('.ad-loading').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			self.resetBtn();
			self.$btn_clicked = $this;
			self.addSpin();
		});
	},

	/**
	 * [loadingCheckbox description]
	 * @return {[type]} [description]
	 */
	loadingCheckbox: function() {
		var self = this;
		$('.ad-checking').on('click', ':checkbox', function(e) {
			self.$box_checked = $(this);
			if ( ! self.checkBoxSpin()) {
				self.$box_status = (this.checked) ? true : false;
				if(self.$box_status) e.preventDefault();
				self.$box_checked.after(AD.Templates.loading_tpl);
				self.$box_checked.hide();
			} else {
				e.preventDefault();
			}
		});
	},

	magnificPopup: function() {
		$('.ad-lightbox').magnificPopup({
			delegate: '[data-toggle=lightbox]',
			type:'image'
		});
	},

	alignTHead: function() {
		var tds = $('tr[data-id]:first > td');
		if(tds) {
			$.each(tds, function(key, td) {
				var percent =  $(td).outerWidth() / $('body').width() * 100;
				$('.ad-thead').find('th').eq(key).css({width: percent+'%'});
			});
		}
	},

	/**
	 * Paginate items in list
	 * @param  {string} item
	 * @return {void}
	 */
	paginateList: function(item) {
		$.LoadNext({
			container: '.ad-paginating',
			item: item,
			label: AD.load,
			btn_class: 'load-more',
			onClickNext: this.paginateSpinner,
			onLoadComplete: function() {
				AD.UI.paginateSpinnerReset();
				AD.UI.alignTHead();
			}
		});
	},

	paginateSpinner: function() {
		var $this = $(this);
		AD.UI.$btn_clicked = $this;
		AD.UI.addSpin();
	},

	paginateSpinnerReset: function() {
		AD.UI.resetBtn();
	},

	/**
	 * [resetCheckbox description]
	 * @return {[type]} [description]
	 */
	resetCheckbox: function() {
		if(this.$box_checked) {
			this.$box_checked.next('i').remove();
			this.$box_checked.prop('checked', this.$box_status);
			this.$box_checked.show();
		}
	},

	resetOtherCheckboxes: function() {
		this.$box_checked.parents('.ad-select')
						 .find('input[type=checkbox]')
						 .prop('checked', false);
	},

	/**
	 * Reset button text content
	 * @return {void}
	 */
	resetBtn: function() {
		var self = this;
		if(!!this.btn_text && !!this.$btn_clicked) {
			self.$btn_clicked.html(self.btn_text);
			self.$btn_clicked = null;
		}		
	},

	resetShake: function() {
		AD.Form.$form.removeClass('shake');
	},

	resetFieldErrors: function() {
		var $form = AD.Form.$form;
		$form.find('.form-group').removeClass('has-error');
		$form.find('.err').remove();
	},

	resetModalShake: function() {
		if(this.$modal) {
			this.$modal.on('hidden.bs.modal', function (e) {
				if(AD.Form.$form) {
					AD.Form.$form.removeClass('shake');
				}
			})
		}
	},

	showLogo: function(to) {
		var $wrapper = $('.login-wrapper');
		$wrapper.on('focus', 'input', function() {			
			$wrapper.addClass('animate');
		}).on('blur', 'input', function() {
			$wrapper.removeClass('animate');
		});
	},

	tagSelectize: function() {
		$('.ad-selectize').selectize({
			delimiter: ',',
			valueField: 'id',
			labelField: 'name',
			searchField: ['name'],
			maxOptions: 10,
			create: function(input) {
				return {
					id: input,
					name: input
				}
			},
			render: {
				item: function(item, escape) {
					return '<div data-value="' + item.id + '">' + item.name + '</div>';
				},
				option: function(item, escape) {
					return '<div data-value="' + item.id + '">' + escape(item.name) + '</div>';
				},
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				var url = AD.Utils.url('api/tags');
				$.post(url, {
					q: query
				}, function(res) {
					callback(res);
				});
			}
		});
	},

	adjustModal: function() {
		$('.modal').each(function() {

			if($(this).hasClass('in') == false){
				$(this).show();
			};

			var contentHeight = $(window).height() - 60;
			var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
			var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;

			$(this).find('.modal-content').css({
				'max-height': function () {
					return contentHeight;
				}
			});

			$(this).find('.modal-body').css({
				'max-height': function () {
					return (contentHeight - (headerHeight + footerHeight));
				}
			});

			$(this).find('.modal-dialog').css({
				'margin-top': function () {
					return ((contentHeight - $(this).outerHeight()) / 2);
				},
			});
		
			if($(this).hasClass('in') == false) {
				$(this).hide();
			};
		});
	},

	windowResize: function(fn) {
		$(window).resize(fn).trigger("resize");
	}

};

AD.Activity = {

	duration: [],
	durationStatic: [],
	timeOut: null,

	init: function() {
		this.start();
		this.stop();
		this.printTime(0);
		this.printStaticTime();
	},

	start: function() {
		var self = this;
		$('.ad-activity').on('click', '.activity-start', function(e) {
			e.preventDefault();
			var $this = $(this);
			var tid = $this.data('id');
			self.postActivity('start', 'api/activity/start', tid);
		});
	},

	stop: function() {
		var self = this;
		$('.ad-activity').on('click', '.activity-stop', function(e) {
			e.preventDefault();
			var $this = $(this);
			var tid = $this.data('id');
			self.postActivity('stop', 'api/activity/stop', tid);
		});
	},

	postActivity: function(action, url, tid) {
		var self = this;
		$.ajax({
				type: "POST",
			url: AD.Utils.url(url),
			data: {
				ticket_id: tid
			},
			success: this.manageActivity,
			context: this,
			dataType: 'json'
		}).done(function() {
			if(action == 'start') {
				AD.UI.resetBtn();				
				self.printTime(0);
			}
		});
	},

	loadStopView: function(data) {
		var tpl = _.template(AD.Templates.stop_btn_tpl);
		var stop_btn = tpl(data);
		$td_wrapper = $('.ad-activity').find('.ad-wrapper[data-id='+data.tid+']');
		$td_wrapper.find('.activity-start').remove();
		$td_wrapper.prepend(stop_btn);
	},

	loadStartView: function(data) {
		var tpl = _.template(AD.Templates.start_btn_tpl);
		var start_btn = tpl(data);
		$td_wrapper = $('.ad-activity').find('.ad-wrapper[data-id='+data.tid+']');
		$td_wrapper.find('.activity-stop').remove();
		$td_wrapper.prepend(start_btn);
	},

	manageActivity: function(data) {
		if(data.action == 'start') this.loadStopView(data);
		if(data.action == 'stop') this.loadStartView(data);
		if(data.msg) AD.UI.createAlertMessage(data);
	},

	formatDigits: function(n) {
		return (n < 10) ? '0' + n : n;
	},

	printTime: function(start) {
		var self = this;
		var placeholders = $('.ad-elapsing');
		clearTimeout(this.timeOut);
		$.each(placeholders, function(key, placeholder) {
			var $placeholder = $(placeholder);
			var secondsBefore = $placeholder.data('start');
			if(start == 0) {
				var duration = moment.duration(secondsBefore, 'seconds');
			} else {
				var duration = start[key].add(1, 's');
			}
			self.duration[key] = duration;
			var timeMask = duration.hours()+'h'
						   + self.formatDigits(duration.minutes())+'m'
						   + self.formatDigits(duration.seconds())+'s';
			$placeholder.html(timeMask);
		});

		// Add seconds
		this.timeOut = setTimeout(function() {
			self.printTime(self.duration);
		}, 1000);
	},

	printStaticTime: function() {
		var self = this;
		var placeholders = $('.ad-elapsed');
		$.each(placeholders, function(key, placeholder) {
			var $placeholder = $(placeholder);
			var secondsBefore = $placeholder.data('start');
			var duration = moment.duration(secondsBefore, 'seconds');
			self.durationStatic[key] = duration;
			var timeMask = duration.hours()+'h'
						   + self.formatDigits(duration.minutes())+'m'
						   + self.formatDigits(duration.seconds())+'s';
			$placeholder.html(timeMask);
		});
	},

	setCheckReport: function() {
		var self = this;
		$('.ad-checkreport').on('click', function() {
			var $el = $(this).parents('tr').find('.ad-reporting');
			$el.trigger('click');
		});
	},

	setToReport: function() {
		var self = this;
		var $report_btn = $('#create-report');
		$('.ad-reporting').on('click', function(e) {
			$report_btn.removeAttr('disabled');
			if($('.ad-reporting:checked').length === 0) {
				$report_btn.attr('disabled', 'disabled');
			}
		});
	}

}

/**
 * A new item factory
 * @type {Object}
 */
AD.Factory = {

	url: null,
	tpl: null,

	createCode: function() {
		var self = this;
		$('#create-code').on('click', function(e) {
			e.preventDefault();
			self.tpl = AD.Templates.new_code_tpl;
			self.url = AD.Utils.url('api/code/create');
			self.sendRequest(null);
		});
	},

	createRole: function() {
		var self = this;
		$('#create-role').on('click', function(e) {
			e.preventDefault();
			self.tpl = AD.Templates.new_role_tpl;
			self.url = AD.Utils.url('api/role/create');
			self.sendRequest(null);
		});
	},

	createUser: function() {
		var self = this;
		$('#create-user').on('click', function(e) {
			e.preventDefault();
			self.tpl = AD.Templates.new_user_tpl;
			self.url = AD.Utils.url('api/user/create');
			self.sendRequest(null);
		});
	},

	processResponse: function(data) {
		if(data.status == 'success') {
			var tpl = _.template(this.tpl);
			var item = tpl(data);

			if(data.render == 'code') this.renderNewCode(item);
			if(data.render == 'role') this.renderNewRole(item);
			if(data.render == 'user') this.renderNewUser(item);
			AD.UI.createAlertMessage(data, null, null);
		}
	},

	renderNewCode: function(item) {
		var $list_item = AD.Sortable.$item_list.find('tbody');
		$list_item.find('.list-empty').remove();
		$list_item.prepend(item);
	},

	renderNewRole: function(item) {
		var $list_item = AD.Sortable.$item_list.find('tbody');
		$list_item.find('.list-empty').remove();
		$list_item.append(item);
	},

	renderNewUser: function(item) {
		var $list_item = AD.Sortable.$item_list.find('tbody');
		$list_item.find('.list-empty').remove();
		$list_item.prepend(item);
	},

	sendRequest: function(params) {
		if(this.url) {
			$.ajax({
				type: "POST",
				url: this.url,
				data: params,
				success: this.processResponse,
				context: this,
				dataType: 'json'
			}).done(function() {
				AD.UI.resetBtn();
				AD.UI.alignTHead();
			});
		} else {
			console.log('No this.url');
		}
	}

};

AD.File = {

	addFileItem: function(item) {
		var file_tpl = _.template(AD.Templates.file_item_tpl);
		var template = file_tpl(item);
		var $list = $('.ad-update');
		$list.find('.list-empty').remove();
		$list.prepend(template);
	},

	showUploadPath: function(text, item) {
		this.addFileItem(item);
		$('li.print').html(text);
		$('[name=file_name]').val('');
		$('[name=file_size]').val('');
	},

	uploadFile: function() {
		var self = this;
		$("#fileuploader").uploadFile({
			url:AD.Utils.url('api/file/upload'),
			fileName:"files",
			formData: {
				page_id: AD.Utils.pageId()
			},
			allowedTypes: AD.mimes,
			maxUploads: AD.max_upload_items,
			uploadButtonClass: "btn btn-primary btn-block button",
			uploadCancelClass: "btn btn-danger abort",
			uploadStartClass: "btn btn-success start",
			progressDivClass: "progress progress-striped active",
			returnType: 'json',

			onSubmit: function(file) {
				// console.log(file);
			},

			onSuccess: function(file, response) {
				
				$('.progress').remove();
				$.each(response, function(key, value) {					
					var $el = $('.status-bar ul > li[rel='+key+']');					
					$el.find('i').removeClass().addClass(value.icon);
					// Has errors
					if(value.errors) {
						var error_tpl = _.template(AD.Templates.file_error_tpl);
						$.each(value.errors, function(type, error) {
							$el.after(error_tpl({error: error}));
						});
					}
					// Success! Append items to file list
					if(value.item) {
						self.addFileItem(value.item);
					}

				});

				AD.UI.createAlertMessage(response);
			}

		});

	}

};

// FORM Management

AD.Form = {

	url: null,
	redirect_uri: null,
	to: 0,	// timeout
	$form: null,	
	$item: null,
	
	init: function() {
		this.confirmDialog();
		this.copyDialog();
		this.submitForm();
		this.submitAjax();
		console.log('init Form');
	},

	confirmDialog: function() {
		var self = this;
		$('.ad-confirming').on('click', '.ad-confirm',function(e) {
			e.preventDefault();
			var $this = $(this);
			var item_id = $this.data('id');
			self.$item = $this.parents('tr').filter('[data-id=' + item_id + ']');
			AD.UI.$modal = $($this.data('target'));
			AD.UI.$modal.find('input[name=item_id]').val(item_id);
			AD.UI.resetModalShake();
		});
	},

	copyDialog: function() {
		var self = this;
		$('.ad-copy').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			AD.UI.$modal = $($this.data('target'));
		});
	},

	submitForm: function() {
		var self = this;
		$('.ad-form-submit').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			if($this.is('[data-form]')) {
				var $form = $('#' + $this.data('form'));
				$form.submit();
			} else {
				$this.parents('form').submit();
			}
		});
	},

	submitAjax: function() {
		var self = this;
		$('.ad-ajax-submit').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);

			if($this.is("[data-to]")) {
				self.to = $this.data('to');
			}

			self.$form = $this.parents('form');
			AD.UI.resetShake();
			self.url = self.$form.attr('action');
			self.sendRequest();
		});
	},

	sendRequest: function() {
		if(this.url) {
			var self = this;
			var timeout = self.to * 1000;
			setTimeout(function() {
				$.ajax({
					type: "POST",
					url: self.url,
					data: self.$form.serialize(),
					success: self.validateForm,
					context: self,
					dataType: 'json'
				}).done(function() {
					AD.UI.resetBtn();
				});
			}, timeout);
		} else {
			console.log('No this.url');
		}
	},

	fieldErrors: function(errors) {
		AD.UI.addShake();
		$.each(errors, function(key, value) {
			$item = $('.form-group[rel='+key+']');
			$item.find('.help-block').remove();
			$item.addClass('has-error');
			$item.find('label').addClass('control-label');
			$item.children('label[for='+key+']').append('<span class="err"> - '+value+'</span>');
		});
		return;
	},

	/**
	 * Redirect to a uri
	 * @param  string uri
	 * @return void
	 */
	redirectTo: function(uri) {
		window.location = AD.Utils.url(uri);
		return;
	},

	redirectUrl: function(url) {
		window.location = url;
		return;
	},

	removeListItem: function(id) {
		var $parent = this.$item.parent();
		this.$item.remove();
		if(!!!$parent.html().trim()) {
			if($parent.hasClass('ad-active')) {
				$parent.append(AD.Templates.empty_tpl);
			} else {
				$parent.siblings('[data-action]').remove();
				$parent.remove();
			}	
		}
		AD.UI.hideModal();
		AD.UI.alignTHead();
	},

	updateForm: function(item, id) {
		$(item).val(id);
	},

	validateForm: function(data) {
		AD.UI.resetFieldErrors();
		if(data.errors) this.fieldErrors(data.errors);
		if(data.remove) this.removeListItem(data.remove);
		if(data.status == 'error') AD.UI.addShake();
		if(data.msg) AD.UI.createAlertMessage(data);
		if(data.print) AD.File.showUploadPath(data.print.text, data.print.item);
		if(data.redirect) this.redirectUrl(data.route);
		if(data.update) this.updateForm(data.update, data.id);
		if(data.close) AD.UI.hideModal();
	}

}

// Selectize Plugin

AD.Selectize = {

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
			render: {
				item: function(item, escape) {
					return '<div data-value="' + item[value] + '">' + item[label] + '</div>';
				},
				option: function(item, escape) {
					if(item.client) {
						var day = moment(item.created_at).format("DD/MM/YYYY");
						return '<div data-value="' + item[value] + '">' + escape(item[label]) + '<span class="select-client-details">' + escape(item.client.rag_sociale) + ' del '+ escape(day) +'</span></div>';
					} else {
						return '<div data-value="' + item[value] + '">' + escape(item[label]) + '</div>';
					}					
				},
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				var url = AD.Utils.url(api_url);
				$.post(url, {
					q: query
				}, function(res) {
					callback(res);
				});
			}
		});
	},

}

// Sortable Plugin

AD.Sortable = {

	$item_list: $('.ad-list'),
	$item_moved: null,
	$spinner_holder: null,

	dropped_id: null,
	dropped_class: null,

	init: function() {
		this.pageList();
		this.pageExpColl();
	},

	checkSpin: function() {
		return this.$spinner_holder.hasClass('fa-spin');
	},

	/**
	 * Execute nestable.js plugin on RoleList
	 * @return {void} 
	 */
	roleList: function() {
		var self = this;
		var enableLoading = self.$item_list.hasClass('ad-moving');

		$('#sort-roles').tableDnD({
			onDragClass: 'warning',
			onDrop: function(table, row, id) {
				var list = $.tableDnD.serialize();
				self.$item_moved = $(row);
				self.reorderItem(id, '.fa-pencil-square-o', enableLoading); 
				self.reorderItemPost(list, 'api/role/move', id, enableLoading);
			}
		});
	},

	/**
	 * Reorder page actions
	 * @param  {int} id
	 * @return {void}
	 */
	reorderItem: function(id, selector, enable) {
		this.dropped_id = id;
		if(enable) this.reorderItemLoading(selector);
	},

	/**
	 * Start loading icon on reorder
	 * @return {void}
	 */
	reorderItemLoading: function(selector) {
		var id = this.dropped_id;
		this.$spinner_holder = this.$item_moved.find(selector);
		var $el = this.$spinner_holder;
		this.dropped_class = $el.attr('class');
		if( ! this.checkSpin()) {
			$el.removeClass().addClass('fa fa-refresh fa-spin');
		} else {
			this.$spinner_holder.removeClass().addClass(this.dropped_class);
			$el.removeClass().addClass('fa fa-refresh fa-spin');
		}
	},

		/**
	 * Reset loading icon on finish reordering
	 * @return {void}
	 */
	reorderItemReset: function() {
		var id = this.dropped_id;
		var $el = this.$spinner_holder;
		$el.removeClass().addClass(this.dropped_class);
	},

	/**
	 * Post JSON array to controller
	 * @return {string} json
	 */
	reorderItemPost: function(list, url, id, enable) {
		var self = this;
		// var itemsJson = self.reorderStringify(list);
		// var page_id = AD.Utils.pageId();
		$.post(AD.Utils.url(url), {
			items: list,
			item: id
		}, function(data) {
			AD.UI.createAlertMessage(data, null, null);
			self.setLevel(data.levels);
		}, 'json').done(function() {
			if(enable) {
				self.reorderItemReset();
			}
		});
	},

	/**
	 * Stringify JSON on reorder list
	 * @return {string} Json object stringified
	 */
	reorderStringify: function(list) {
		// var list_lang = AD.UI.activePageList();
		if(JSON && list) {
			var serialObj = list.nestable('serialize');
			return JSON.stringify(serialObj);
		} else {
			var data = {
				status: 'error',
				msg: 'Unsupported browser!'
			}
			AD.UI.createAlertMessage(data, null, null);
		}
	},

	setLevel: function(levels) {
		$.each($('#sort-roles').find('tr'), function(index, tr) {
			$(tr).find('td').eq(2).html(levels[index]);
		});
	},
}

// Templates

AD.Templates = {

	empty_tpl: 		'<tr class="list-empty"><td>' + AD.noresult + '</td><</tr>',

	stop_tpl: 		'<span class="ad-hovertext"><i class="fa fa-pause"></i> ' + AD.stop + '</span>',

	file_error_tpl:	'<li class="error msg"><i class="fa fa-exclamation-circle"></i><%= error %></li>',

	file_item_tpl:	'<li class="file-item" data-id="<%= id %>">' +
						'<% if(is_image) { %>' +
						'<p><a href="<%= url_link %>" data-toggle="lightbox"><%= ico %></a><span><%= file_name %></span></p>' +
						'<% } else { %>' +
						'<p><a href="<%= url_link %>" target="_blank"><%= ico %></a><span><%= file_name %></span></p>' +
						'<% } %>' +
						'<label>' +
							'<input type="checkbox" value="<%= id %>" class="ad-checkbox" checked="checked">' +
							'<strong></strong>' +
						'</label>' +
						'<div class="btn-edit">' +
							'<a href="<%= url_edit %>" class="btn btn-sm btn-primary">' +
								'<i class="fa fa-pencil-square-o"></i></a>\n' +
							'<a href="#" data-toggle="modal" data-target=".file-delete" data-id="<%= id %>" class="btn btn-sm btn-danger ad-confirm">' +
								'<i class="fa fa-trash-o"></i></a>' +
						'</div>' +
					'</li>',

	file_tool_tpl:  '<li class="file-item">' +			
						'<div>' +
							'<a href="<%= url %>" data-toggle="lightbox" class="ad-img">' +
								'<img src="<%= cms_url %>" class="cms-thumb" alt=""></a>' +
							'<p><%= name %></p>' +
						'</div>' +
						'<a href="<%= name %>" class="ad-insert" data-tag="img">' +
							'<i class="fa fa-chevron-right"></i></a>' +		
					'</li>',

	loading_tpl: 	'<i class="fa fa-refresh fa-spin"></i> ',

	new_code_tpl: 	'<tr data-id="<%= id %>">' +
						'<td>' +
							'<input type="checkbox" value="<%= id %>" class="ad-checkbox">' +
						'</td>' +
						'<td><%= code %></td>' +
						'<td><%= name %></td>' +
						'<td>' +
							'<a href="<%= url_edit %>" class="btn btn-xs btn-primary">' +
								'<i class="fa fa-pencil-square-o"></i> <%= edit_label %></a>\n' +
							'<a href="#" data-toggle="modal" data-target=".ad-delete" data-id="<%= id %>" class="btn btn-xs btn-danger ad-confirm">' +
								'<i class="fa fa-trash-o"></i> <%= delete_label %></a>' +
						'</td>' +
					'</tr>',

	new_role_tpl:	'<tr class="move" data-id="<%= id %>">' +
						'<td>' +
							'<input type="checkbox" value="<%= id %>" class="ad-checkbox">' +
						'</td>' +
						'<td><%= rolename %></td>' +
						'<td><%= level %></td>' +
						'<td>' +
							'<a href="<%= url_edit %>" class="btn btn-xs btn-primary">' +
								'<i class="fa fa-pencil-square-o"></i> <%= edit_label %></a>\n' +
							'<a href="#" data-toggle="modal" data-target=".ad-delete" data-id="<%= id %>" class="btn btn-xs btn-danger ad-confirm">' +
								'<i class="fa fa-trash-o"></i> <%= delete_label %></a>' +
						'</td>' +
					'</tr>',

	new_user_tpl:	'<tr data-id="<%= id %>">' +
						'<td>' +
							'<input type="checkbox" value="<%= id %>" class="ad-checkbox">' +
						'</td>' +
						'<td><%= username %></td>' +
						'<td><%= email %></td>' +
						'<td><%= role_name %> (<%= role_level %>)</td>' +
						'<td>' +
							'<a href="<%= url_edit %>" class="btn btn-xs btn-primary">' +
								'<i class="fa fa-pencil-square-o"></i> <%= edit_label %></a>\n' +
							'<a href="#" data-toggle="modal" data-target=".ad-delete" data-id="<%= id %>" class="btn btn-xs btn-danger ad-confirm">' +
								'<i class="fa fa-trash-o"></i> <%= delete_label %></a>' +
						'</td>' +
					'</tr>',

	stop_btn_tpl: 	'<a href="#" data-id="<%= tid %>" class="btn btn-xs btn-danger activity-stop ad-hover" data-hover="stop">' +
						'<span class="elapsed ad-elapsing" data-start=<%= total_seconds %>></span>' +
					'</a>\n',

	start_btn_tpl: 	'<a href="#" data-id="<%= tid %>" class="btn btn-xs btn-primary ad-loading activity-start">' +
						'<i class="fa fa-play"></i> <%= start_label %>' +
					'</a>\n',
}

// Togglers

AD.Toggle = {

	$change_lang: $('#change-lang'),
	$change_zone: $('#change-zone'),
	$layout_wrapper: $('.layout-wrapper'),
	$block_wrapper: null,
	$was_checked: null,

	must_save: false,

	init: function() {
		// this.togglePages();
		// this.toggleOptions();
		this.toggleSearch();
		// this.toggleSelect();
		this.toggleActive();
		// this.toggleEnabling();
		// this.toggleSetting();		
		// this.untoggleOverlay();
		// this.toggleDelete('a', 'ad-confirm');
	},

	/**
	 * Toggle Markers API
	 * @return {void}
	 */
	toggleApi: function() {
		$('.api-toggle').on('click', function(e) {
			e.preventDefault();
			$(this).closest('div').find('.api').toggle();
		});
	},

	/**
	 * Toggle ajax is_valid checkboxes
	 * @return {void}
	 */
	toggleSelect: function() {
		var self = this;
		$('.ad-select').on('click', '.ad-checkbox', function(e) {
			var $this = $(this);
			self.$was_checked = $this.parents('.ad-select').find('input[type=checkbox]:checked');
			if (AD.UI.checkBoxSpin() && AD.UI.$box_checked != $this) {
				AD.UI.resetCheckbox();
			}
			AD.UI.$box_checked = $this;
			AD.UI.resetOtherCheckboxes();
			if ( ! AD.UI.checkBoxSpin()) {
				var item_id = $this.val();
				var url = $this.parents('form').attr('action');
				var user_id = $this.parents('form').data('user');
				$.post(url, {
					item_id: item_id,
					user_id: user_id
				}, function(data) {
					if(data.status == 'error') {
						self.$was_checked.prop('checked', true);	
					} else {
						AD.UI.$box_status = true;
					}
					AD.UI.createAlertMessage(data, null, null);
				}, 'json').done(function() {
					AD.UI.resetCheckbox();
				});
			} else {
				e.preventDefault();
			}
		});
	},

	/**
	 * Toggle ajax is_valid checkboxes
	 * @return {void}
	 */
	toggleActive: function() {
		var self = this;
		$('.ad-active').on('click', '.ad-checkbox', function(e) {
			var $this = $(this);
			// Check another box is working
			if (AD.UI.checkBoxSpin() && AD.UI.$box_checked != $this)
			{
				AD.UI.resetCheckbox();
			}
			AD.UI.$box_checked = $this;
			if ( ! AD.UI.checkBoxSpin()) {
				var item_id = $this.val();
				var action = (this.checked) ? 1 : 0;
				var url = $this.parents('form').attr('action');
				$.post(url, {
					item_id: item_id,
					action: action
				}, function(data) {
					// AD.UI.createAlertMessage(data, null, null);
				}, 'json').done(function() {
					AD.UI.resetCheckbox();
				});
			} else {
				e.preventDefault();
			}
		});
	},

	toggleSetting: function() {
		var self = this;
		$('.ad-setting').on('change', 'select', function(e) {
			e.preventDefault();
			var $this = $(this);
			var item_name = $this.attr('name');
			var item_value = $this.val();
			var url = $this.parents('form').attr('action');
			$.post(url, {
				item_name: item_name,
				value: item_value
			}, function(data) {
				AD.UI.createAlertMessage(data, null, null);
			}, 'json').done(function() {
				AD.UI.resetCheckbox();
			});
		});
	},

	toggleDelete: function(target, add_class) {
		var self = this;
		var is_active = [];
		$('.ad-deleting').on('click', ':checkbox', function(e) {
			var $this = $(this);
			var show = (this.checked) ? false : true;
			var $target = $this.parent().next(target);
			var id = $target.data('id');
			var link = $target.data('link');
			if(is_active[id] == undefined) {
				is_active[id] = $target.hasClass('active');
			}
			var page_id = ($this.is("[data-page]")) ? $this.data('page') + '/' : '';
			var edit_url = AD.Utils.url(link + '/edit/' + page_id + $target.data('id'));
			var url = $target.attr('href');
			var arrow = $target.data('arrow');
			var link_ico = 'fa-chevron-'+arrow;
			var data_target = ($target.data('link') == 'page') ? '.page-delete' : '.ad-delete';
			if(show) {
				$target.addClass(add_class)
					   .attr('data-toggle', 'modal')
					   .attr('data-target', data_target)
					   .attr('href', '#');
				if(is_active[id]) $target.removeClass('active');
				$target.find('i').toggleClass(link_ico + ' fa-trash-o');
			} else {
				$target.removeClass(add_class)
					   .removeAttr('data-toggle')
					   .removeAttr('data-target')
					   .attr('href', edit_url);
				if(is_active[id]) $target.addClass('active');
				$target.find('i').toggleClass('fa-trash-o ' + link_ico);
			}
		});
	},





	/**
	 * Show/hide options sidebar
	 * @return {void}
	 */
	toggleOptions: function() {
		$('.options-toggle').on('click', function(e) {
			e.preventDefault();
			AD.UI.$body.toggleClass('push-left');
		});
	},

	/**
	 * Show/hide tools sidebar
	 * @return {void}
	 */
	toggleTools: function() {
		$('.tools-toggle').on('click', function(e) {
			e.preventDefault();
			AD.UI.$body.toggleClass('hide-tools');
		});
	},

	/**
	 * Show/hide page manager
	 * @return {void}
	 */
	togglePages: function() {
		var self = this;
		$('.pages-toggle').on('click', function(e) {
			e.preventDefault();
			if(AD.UI.$body.hasClass('push-left')) {
				AD.UI.$body.removeClass();
				self.resetBlocksLayout();
			}
			AD.UI.$body.toggleClass('push-right');
		});
	},

	toggleSearch: function() {
		var self = this;
		$('.search-toggle').on('click', function(e) {
			e.preventDefault();
			AD.UI.$breadcrumb.toggleClass('search-open');
		});
	},

	untoggleOverlay: function() {
		var self = this;
		AD.UI.$overlay.on('click', function() {
			AD.UI.$body.removeClass('push-left push-right');
			self.resetBlocksLayout();
		});
	},

	resetBlocksLayout: function() {
		if(AD.UI.$layout_radio) {
			AD.UI.$layout_radio.prop('checked', false);
			this.$block_wrapper.empty();
		}
	},

};

// Utils

AD.Utils = {

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
		return AD.site + uri;
	},

	/**
	 * Format a URL
	 * @param  string
	 * @return string
	 */
	url: function(uri) {
		return AD.base + '/' + uri;
	},

};

// Knockout.js MVVM

AD.VM = {

	countChars: function(observed, max_len) {
		var len = observed().length;
		var text = observed();

		if(len > max_len) {
			observed(text.substring(0, max_len));
			return 0;
		}
		return max_len - len;
	},

	makeSlug: function(url) {		
		return url.trim()
				  .toLowerCase()
				  .replace(/ +/g,'-')
				  .replace(/-+/g,'-');
	},

	blockEdit: function() {
		var self = this;
		self.itemName = ko.observable($('#name').val());
		self.blockAttrib = ko.observable($('#attrib').val());

		self.createAttrib = function() {
			var name = self.itemName();			
			var slugged = name.toLowerCase()
					   	  .replace(/[^\w ]+/g,'')
					   	  .replace(/ +/g,'-');

			self.blockAttrib(slugged);
		}
	},

	codeEdit: function() {
		var self = this;
		self.itemName = ko.observable($('#name').val());
	},

	pageEdit: function() {
		var self = this;
		self.itemName = ko.observable($('#name').val());
		self.pageSlug = ko.observable($('#slug').val());
		self.slug = ko.computed(function() {
			return self.pageSlug();
		});

		self.pageTitle = ko.observable($('#title').val());
		self.pageDescr = ko.observable($('#descr').val());

		self.titleLen = ko.computed(function() {
			var observed = self.pageTitle;
			return AD.VM.countChars(observed, 70);
		});

		self.descrLen = ko.computed(function() {
			var observed = self.pageDescr;
			return AD.VM.countChars(observed, 250);
		});

		self.createSlugName = function() {
			var slugged = AD.VM.makeSlug(self.itemName());
			$('#slug').val(slugged);
			$('#slug-last').html(slugged);
		}

		self.createSlugThis = function() {
			var $slug = $('#slug');
			var slug = $slug.val();
			var slugged = AD.VM.makeSlug(slug);
			$('#slug').val(slugged);
			$('#slug-last').html(slugged);
		}

	},

	roleEdit: function() {
		var self = this;
		self.itemName = ko.observable($('#name').val());
	},

	userEdit: function() {
		var self = this;
		self.itemName = ko.observable($('#username').val());
		self.itemPassword = ko.observable($('#password').val());
		self.itemConfirmed = ko.observable($('#password_confirmation').val());
		self.iconFeedbackError = ko.observable(false);
		self.iconFeedback = ko.observable(false);
		self.iconCheckError = ko.observable(false);
		self.iconCheck = ko.observable(false);

		self.fieldStatus = ko.computed(function() {
			var len = self.itemPassword().length;
			var css = 'form-group';
			if(len > 0 && len < 8) {
				css = css + ' has-error has-feedback';
				self.iconFeedbackError(true);
				self.iconFeedback(false);
			}
			if(len >= 8) {
				css = css + ' has-success has-feedback';
				self.iconFeedbackError(false);
				self.iconFeedback(true);
			}
			if(len == 0) {
				self.iconFeedbackError(false);
				self.iconFeedback(false);
			}
			return css;
		}, self);

		self.passwordCheck = ko.computed(function() {
			var css = 'form-group';
			var len = self.itemConfirmed().length;
			if(len > 0 && self.itemConfirmed() === self.itemPassword()) {
				self.iconCheckError(false);
				self.iconCheck(true);
				css = css + ' has-success has-feedback';
			}
			if(len > 0 && self.itemConfirmed() !== self.itemPassword()) {
				self.iconCheckError(true);
				self.iconCheck(false);
				css = css + ' has-error has-feedback';
			}
			if(len == 0) {
				self.iconCheckError(false);
				self.iconCheck(false);
			}
			return css;
		});
	}

};

// init App
$(function() {

	AD.UI.init();

	console.log('AD.js loaded and minified!', new Date());
});

