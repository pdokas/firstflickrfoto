<?php

	require('../config/config.inc');

	setcookie('fullname', '', 0);
	setcookie('oauth_token', '', 0);
	setcookie('oauth_token_secret', '', 0);
	setcookie('user_nsid', '', 0);
	setcookie('username', '', 0);
	
	header("Location: $domain");

?>