<?php

	$domain = 'http://jetless.org/projects/firstflickrfoto';

	$app_key    = 'b44d57f6779c99a9e59180b18577a36c';
	$app_secret = '3885aeb02d6286a2';

	$oauth_version    = '1.0';
	$oauth_sig_method = 'HMAC-SHA1';

	$defaults = array(
		'oauth_consumer_key'     => $app_key,
		'oauth_nonce'            => '',
		'oauth_signature_method' => $oauth_sig_method,
		'oauth_timestamp'        => '',
		'oauth_version'          => $oauth_version
	);

	$token         = '';
	$token_secret  = '';
	
	$flickr_endpoint = 'http://api.flickr.com/services/rest';

?>