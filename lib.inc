<?php

	function getContactList() {
		$params = array(
			'method' => 'flickr.contacts.getList'
		);

		return request($params, 'json');
	}
	
	function getPhoto($who, $page = 1) {
		$params = array(
			'method'   => 'flickr.people.getPhotos',
			'user_id'  => $who,
			'per_page' => 1,
			'page'     => $page
		);
		
		return request($params, 'json');
	}
	
	#
	# OAuth token getters
	#
	
	function getRequestToken() {
		global $domain;

		$url    = 'http://www.flickr.com/services/oauth/request_token';
		$params = array(
			'oauth_callback' => "{$domain}/oauth/process.php"
		);

		return request($params, 'oauth', $url);
	}
	
	function getAccessToken() {
		$url    = 'http://www.flickr.com/services/oauth/access_token';
		$params = array(
			'oauth_token'    => $_GET['oauth_token'],
			'oauth_verifier' => $_GET['oauth_verifier']
		);
		
		return request($params, 'oauth', $url);
	}
	
	
	#
	# Ye olde toolbelte
	#
	
	function formatParams($params = array()) {
		global $defaults, $app_key, $token;
		$ret = '';
		
		if ($params['method']) {
			$params['api_key']        = 'app_key';
			$params['format']         = 'json';
			$params['nojsoncallback'] = '1';
			$params['oauth_token']    = $token;
		}
		
		# Always recalc these
		$params['oauth_timestamp'] = time();
		$params['oauth_nonce']     = uniqid();
		
		$params = array_merge($defaults, $params);
		ksort($params);
		
		$i = 0;
		foreach ($params as $key => $val) {
			if ($i > 0) { $ret .= '&'; }
			
			$ret .= "{$key}=" . rawurlencode($val);
			$i++;
		}
		
		return $ret;
	}
	
	function request($params, $format, $url = FLICKR_ENDPOINT) {
		$ret = '';
		
		$params = formatParams($params);
		$url    = $url . "?{$params}&oauth_signature=" . sign($url, $params);
		$data   = file_get_contents($url);
		
		switch ($format) {
			case 'json':
				$ret = json_decode($data, TRUE);
			break;
			
			case 'oauth':
				$ret = explodeResponse($data);
			break;
		}
		
		return $ret;
	}
	
	function sign($url, $params, $method = 'GET') {
		global $app_secret, $token_secret;
		
		$key         = "{$app_secret}&{$token_secret}";
		$base_string = $method . '&' . rawurlencode($url) . '&' . rawurlencode($params);
		
		return urlencode(base64_encode(hash_hmac('sha1', $base_string, $key, TRUE)));
	}
	
	function explodeResponse($resp) {
		$ret = array();
		
		$keyVals = explode('&', $resp);
		
		for ($i = 0, $keyCount = count($keyVals); $i < $keyCount; $i++) {
		    $keyVal = explode('=', $keyVals[$i]);
		
			$ret[urldecode($keyVal[0])] = urldecode($keyVal[1]);
		}
		
		return $ret;
	}

?>
