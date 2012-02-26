$(function() {
	$(document).on('click', '.person', function(e) {
		window.open($(this).data('photoUrl'), 'firstfoto');
	});
});