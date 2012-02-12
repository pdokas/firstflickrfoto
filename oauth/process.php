<?php

	require('../config/config.inc');
	require('../lib.inc');
	
	$oauth_token    = $_GET['oauth_token'];
	$oauth_verifier = $_GET['oauth_verifier'];
	#
	# Instead of the awful hack below, retrieve the oauth_token_secret that corresponds to oauth_token from the db
	# and use it for signing the next call
	# 	Then delete that row
	#
	$oauth_token_secret = $_GET['awful_hacky_secret_delivery_mechanism'];
	
	if ($oauth_token_secret) {
		$request = getAccessToken();

		$expiration = time() + (60 * 60 * 24 * 30); // 30 days

		setcookie('fullname', $request['fullname'], $expiration, '/projects/firstflickrfoto');
		setcookie('oauth_token', $request['oauth_token'], $expiration, '/projects/firstflickrfoto');
		setcookie('oauth_token_secret', $request['oauth_token_secret'], $expiration, '/projects/firstflickrfoto');
		setcookie('user_nsid', $request['user_nsid'], $expiration, '/projects/firstflickrfoto');
		setcookie('username', $request['username'], $expiration, '/projects/firstflickrfoto');
		
		header("Location: $domain");
	}
	else {
		echo 'awful_hacky_secret_delivery_mechanism';
	}

?>
