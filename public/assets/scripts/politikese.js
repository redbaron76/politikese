var Politikese = {};

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

// init App
$(function() {

	Politikese.UI.init();

});

