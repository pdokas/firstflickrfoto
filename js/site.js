$(document).on('click', '.photo', function(e) {
	var photo = $(this);
	
	if (photo.data('photoId')) {
		window.open(photo.data('personUrl') + photo.data('photoId'), 'firstfoto');
	}
});

$('.photo').each(function(i) {
	var elt = $(this);
	
	$.getJSON('ajax/firstfoto.php', { nsid: elt.data('nsid') }, function(response) {
		var date, dateString;
		
		if (response.status === 'ok') {
			data = response.data;

			if (data) {
				date       = new Date(1000 * data.dateupload);
				dateString = (1 + date.getMonth()) + '/' + date.getDate() + '/' + date.getFullYear();
				
				elt.data('photoId', data.id);
				elt.addClass('clickable');
				elt.css(
					'background-image',
					'url(http://farm' + data.farm + '.staticflickr.com/' + data.server + '/' + data.id + '_' + data.secret + '_m.jpg)'
				);
				
				elt.attr('title', data.title);
				
				elt.next('.nametag').find('.timestamp').text(dateString).addClass('visible');
			}
		}
	});
});
