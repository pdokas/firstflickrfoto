<?php

	require('lib.inc');
	
	if (ensure_login()) {
		$people = array();
		
		$contacts = getContactList();
				
		foreach ($contacts['contacts']['contact'] as $i => $c) {
			$person = array();
			
			$person['nsid'] = $c['nsid'];
			
			# Get name
			$person['name'] = $c['username'];
			
			# Get photostream url
			if ($c['path_alias']) {
				$person['url'] = "http://www.flickr.com/photos/{$c['path_alias']}/";
			}
			else {
				$person['url'] = "http://www.flickr.com/photos/{$c['nsid']}/";
			}
			
			# Get buddyicon
			if ($c['iconserver']) {
				$person['buddyicon'] = "http://farm{$c['iconfarm']}.staticflickr.com/{$c['iconserver']}/buddyicons/{$c['nsid']}.jpg";
			}
			else {
				$person['buddyicon'] = 'http://www.flickr.com/images/buddyicon.jpg';
			}
			
			# Get first photo
			$firstPhoto = getFirstPhoto($c['nsid']);
			$person['first_photo'] = $firstPhoto['photos']['photo'][0];
			
			$people[] = $person;
		}
		
		include('templates/homepage.php');
	}
	else {
		$request = getRequestToken();

		# 
		# Here's the deal. You need a DB table to store (oauth_token, oauth_token_secret) pairs.
		# When exchanging the request token for the access token, you need to sign the request with this oauth_token_secret.
		#
		# 	So at exchange time, look up oauth_token_secret by oauth_token
		#		On success, delete that row (as the token will never be used again)
		# 

		$nextStep = "http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}";
		// header("Location: http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}");
		
		include('templates/signin.php');
	}

?>
