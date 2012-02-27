$(document).on('click', '.person', function(e) {
	var person = $(this),
		photo  = person.find('.photo');
	
	if (photo.data('photoId')) {
		window.open(person.data('personUrl') + photo.data('photoId'), 'firstfoto');
	}
});

$('.photo').each(function(i) {
	var elt = $(this);
	
	$.getJSON('ajax/firstfoto.php', { nsid: elt.data('nsid') }, function(data, status, xhr) {
		if (data.status === 'ok') {
			data = data.data;

			if (data) {
				elt.data('photoId', data.id);
				elt.css('background-image', 'url(http://farm' + data.farm + '.staticflickr.com/' + data.server + '/' + data.id + '_' + data.secret + '_m.jpg)');
			}
		}
	});
});