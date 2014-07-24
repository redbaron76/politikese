$(function() {
	AD.Selectize.itemSelect('.select-ticket', 'id', 'activity_code', 5, 'api/ticket/search');
	console.log('sections/reports/edit.js loaded!');
});