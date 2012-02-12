<?php

	require('config.inc');
	require('lib.inc');
	
	if ($_COOKIE['oauth_token']) {
		$token        = $_COOKIE['oauth_token'];
		$token_secret = $_COOKIE['oauth_token_secret'];
		
		$params = formatParams(array(
			'method' => 'flickr.contacts.getList'
		));

		$data = request($flickr_endpoint, $params, 'json');
		
		var_dump($data);
	}
	else {
		$request = getRequestToken();

		# 
		# Here's the deal. You need a DB table to store (oauth_token, oauth_token_secret) pairs.
		# When exchanging the request token for the access token, you need to sign the request with this token_secret.
		#
		# 	So at exchange time, look up oauth_token_secret by oauth_token
		#		On success, delete that row (as the token will never be used again)
		# 

		var_export($request);
		$nextStep = "http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}";
		// header("Location: http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$request['oauth_token']}");

		function getRequestToken() {
			global $domain;

			$url    = 'http://www.flickr.com/services/oauth/request_token';
			$params = formatParams(array(
				'oauth_callback' => "{$domain}/oauth/process.php"
			));

			return request($url, $params, 'oauth');
		}
	}

?>

<a href='<?php echo $nextStep; ?>'>Go west, young man</a>
