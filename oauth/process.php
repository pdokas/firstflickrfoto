<?php

	require('../config.inc');
	require('../lib.inc');
	
	$oauth_token    = $_GET['oauth_token'];
	$oauth_verifier = $_GET['oauth_verifier'];
	
	#
	# Retrieve the oauth_token_secret that corresponds to oauth_token, use it for signing the next call
	# 	Then delete that row
	#
	# 	$token_secret = $_GET['secret'];
	#
	
	$request = getAccessToken();

?>
