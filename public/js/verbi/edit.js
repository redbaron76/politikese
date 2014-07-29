$(function() {
	Politikese.Selectize.itemSelect('.select-articoli', 'id', 'text', 5, 'api/articoli');
	Politikese.Selectize.itemSelect('.select-preposizioni', 'id', 'text', 5, 'api/preposizioni');
	Politikese.Selectize.itemAddSelect('.select-tags', 'id', 'text', 5, 'api/tags');
	console.log('sections/verbi/edit.js');
});