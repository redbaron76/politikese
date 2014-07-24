$(function() {
	AD.Activity.printTime(0);
	AD.Selectize.itemSelect('.select-client', 'user_id', 'rag_sociale', 1, 'api/client/search');
	AD.Selectize.itemSelect('.select-operator', 'id', 'username', 5, 'api/user/operators');
	console.log('sections/tickets/edit.js loaded!');
});