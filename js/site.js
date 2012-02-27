$(document).on('click', '.photo', function(e) {
	var photo = $(this);
	
	if (photo.data('photoId')) {
		window.open(photo.data('personUrl') + photo.data('photoId'), 'firstfoto');
	}
});

$('.photo').each(function(i) {
	var elt = $(this);
	
	$.getJSON('ajax/firstfoto.php', { nsid: elt.data('nsid') }, function(response) {
		if (response.status === 'ok') {
			data = response.data;

			if (data) {
				elt.data('photoId', data.id);
				elt.addClass('clickable');
				elt.css('background-image', 'url(http://farm' + data.farm + '.staticflickr.com/' + data.server + '/' + data.id + '_' + data.secret + '_m.jpg)');
			}
		}
	});
});