<?php

	require('config.inc');
	require('lib.inc');
	
	$oauth_token = getRequestToken();
	header("Location: http://www.flickr.com/services/oauth/authorize?perms=read&oauth_token={$oauth_token}");
	
	function getRequestToken() {
		global $domain;
		
		$url    = 'http://www.flickr.com/services/oauth/request_token';
		$params = formatParams(array(
			'oauth_callback' => "{$domain}/oauth/process.php"
		));
		
		$signature = sign($url, $params);

		$request_url = $url . "?{$params}&oauth_signature=" . urlencode($signature);
		$resp_values = explodeResponse(file_get_contents($request_url));
		
		return $resp_values['oauth_token'];
	}

?>

<pre>
http://www.flickr.com/services/oauth/request_token
	?oauth_nonce=95613465
	&oauth_timestamp=1305586162
	&oauth_consumer_key=653e7a6ecc1d528c516cc8f92cf98611
	&oauth_signature_method=HMAC-SHA1
	&oauth_version=1.0
	&oauth_signature=7w18YS2bONDPL%2FzgyzP5XTr5af4%3D
	&oauth_callback=http%3A%2F%2Fwww.example.com

oauth_callback_confirmed=true
	&oauth_token=72157626737672178-022bbd2f4c2f3432
	&oauth_token_secret=fccb68c4e6103197

-- Redirect to Flickr
http://www.flickr.com/services/oauth/authorize
	?oauth_token=72157626737672178-022bbd2f4c2f3432
	
-- Flickr winds back up here (via oauth_callback in step 1)
http://www.example.com/
	?oauth_token=72157626737672178-022bbd2f4c2f3432
	&oauth_verifier=5d1b96a26b494074

http://www.flickr.com/services/oauth/access_token
	?oauth_nonce=37026218
	&oauth_timestamp=1305586309
	&oauth_verifier=5d1b96a26b494074
	&oauth_consumer_key=653e7a6ecc1d528c516cc8f92cf98611
	&oauth_signature_method=HMAC-SHA1
	&oauth_version=1.0
	&oauth_token=72157626737672178-022bbd2f4c2f3432
	&oauth_signature=UD9TGXzrvLIb0Ar5ynqvzatM58U%3D

fullname=Jamal%20Fanaian
	&oauth_token=72157626318069415-087bfc7b5816092c
	&oauth_token_secret=a202d1f853ec69de
	&user_nsid=21207597%40N07
	&username=jamalfanaian

http://api.flickr.com/services/rest
	?nojsoncallback=1
	&format=json
	&method=flickr.test.login
	&oauth_nonce=84354935
	&oauth_consumer_key=653e7a6ecc1d528c516cc8f92cf98611
	&oauth_timestamp=1305583871
	&oauth_signature_method=HMAC-SHA1
	&oauth_version=1.0
	&oauth_token=72157626318069415-087bfc7b5816092c
	&oauth_signature=dh3pEH0Xk1qILr82HyhOsxRv1XA%3D

{
	"user":{
		"id":"21207597@N07",
		"username":{
			"_content":"jamalfanaian"
		}
	},
	"stat":"ok"
}
</pre>
