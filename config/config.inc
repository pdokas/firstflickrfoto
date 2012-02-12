<?php

	require('flickr_api_credentials.inc');

	$domain = 'http://jetless.org/projects/firstflickrfoto';

	$oauth_token        = '';
	$oauth_token_secret = '';
	$oauth_version      = '1.0';
	$oauth_sig_method   = 'HMAC-SHA1';

	$defaults = array(
		'oauth_consumer_key'     => $app_key,
		'oauth_nonce'            => '',
		'oauth_signature_method' => $oauth_sig_method,
		'oauth_timestamp'        => '',
		'oauth_version'          => $oauth_version
	);
	
	define(FLICKR_ENDPOINT, 'http://api.flickr.com/services/rest');

?>
